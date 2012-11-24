<?php
/**
 * Form for logging in.
 *
 * @author Brad Chen
 */

if ($_POST) {
  if (is_input_valid()) {
    array_push($_SESSION['users'], array(
      'login' => trim($_POST['login']),
      'password' => trim($_POST['password'])
    ));
    $_SESSION['MESSAGE'] = '<strong>Success!</strong> User has been added.';
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit(0);
}

function is_input_valid() {
  if (empty($_POST['login']) || empty($_POST['password'])) {
    $_SESSION['ERROR'] = '<strong>Error!</strong> Please enter all fields.';
    return false;
  }
  foreach ($_SESSION['users'] as $user) {
    if (($user['login'] == trim($_POST['login']))) {
      $_SESSION['ERROR'] = '<strong>Error!</strong> User already exists.';
      return false;
    }
  }
  return true;
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
    class="form-horizontal">
  <fieldset>
    <legend>Add a New User</legend>

    <div class="control-group">
      <label class="control-label" for="login">Login</label>
      <div class="controls">
        <input type="text" id="login" name="login" placeholder="Login" />
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="text" id="password" name="password"
          placeholder="Password" />
      </div>
    </div>

    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>

