<?php
/**
 * Page header.
 *
 * @author Brad Chen
 */

session_start();
ob_start();

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
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>A Naïve Data Entry Site</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" type="text/css" />
    <link rel="stylesheet" href="styles.css" type="text/css" />
    <script type="text/javascript" src="jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="page-header">
        <?php if (isset($_SESSION['LOGGED_IN'])) : ?>
          <a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout"
            class="pull-right">Log out</a>
        <?php endif; ?>

        <h1>A Naïve Data Entry Site</h1>
      </div>

      <?php if ($error) : ?>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <?php echo $error; ?>
        </div>
      <?php endif; ?>

      <?php if ($message) : ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <?php echo $message; ?>
        </div>
      <?php endif; ?>
