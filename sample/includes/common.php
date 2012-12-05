<?php
/**
 * Common procedures.
 *
 * @author Brad Chen
 */

ob_start();
session_start();

if (isset($_SESSION['CSRF_PROTECTION'])) {
  if (!isset($_SESSION['CSRF_TOKEN'])) {
    generate_csrf_token();
  }
  if ($_POST) {
    check_csrf_attack(isset($_POST['token']) ? $_POST['token'] : null);
  }
}

// initialize the list of data
if (!isset($_SESSION['users'])) {
  $_SESSION['users'] = array(
    array(
      'login' => 'btn710',
      'password' => 'btn710'
    )
  );
}

if (isset($_GET['logout'])) {
  $_SESSION['MESSAGE'] = '<strong>See you</strong>. Logged out successfully.';
  unset($_SESSION['LOGGED_IN']);
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit(0);
}

$error = isset($_SESSION['ERROR']) ? $_SESSION['ERROR'] : null;
$message = isset($_SESSION['MESSAGE']) ? $_SESSION['MESSAGE'] : null;
unset($_SESSION['ERROR']);
unset($_SESSION['MESSAGE']);

function check_csrf_attack($token) {
  if (!isset($_SESSION['CSRF_PROTECTION'])) {
    return;
  }
  if (isset($_SESSION['CSRF_TOKEN']) && !empty($token)
        && ($_SESSION['CSRF_TOKEN'] == $token)) {
    return;
  }

  unset($_SESSION['CSRF_TOKEN']);
  ob_end_clean();
  $_SESSION['ERROR'] = '<strong>Error!</strong> The form has expired. '
    . 'Please try again.';
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit(0);
}

function generate_csrf_token() {
  $_SESSION['CSRF_TOKEN'] = sha1(rand(pow(10, 4), getrandmax()));
}

