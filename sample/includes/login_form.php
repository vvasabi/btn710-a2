<?php
/**
 * Form for logging in.
 *
 * @author Brad Chen
 */

if ($_POST) {
  if (!is_login_valid()) {
    $_SESSION['ERROR'] = '<strong>Unable to log in</strong>. Please try again.';
  } else {
    $_SESSION['MESSAGE'] = '<strong>Hello!</strong> Logged in successfully.';
    $_SESSION['LOGGED_IN'] = true;
  }

  generate_csrf_token();
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit(0);
}

function is_login_valid() {
  if (empty($_POST['login']) || empty($_POST['password'])) {
    return false;
  }
  foreach ($_SESSION['users'] as $user) {
    if (($user['login'] == $_POST['login'])
          && ($user['password'] == $_POST['password'])) {
      return true;
    }
  }
  return false;
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
    class="form-horizontal">
  <fieldset>
    <legend>Please Login</legend>

    <div class="control-group">
      <label class="control-label" for="login">Login</label>
      <div class="controls">
        <input type="text" id="login" name="login" placeholder="Login" />
        <span class="help-inline">Tip: use &ldquo;btn710&rdquo;</span>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password"
          placeholder="Password" />
        <span class="help-inline">Tip: use the same as above</span>
      </div>
    </div>

    <div class="control-group">
      <div class="controls">
        <?php if (isset($_SESSION['CSRF_PROTECTION'])) : ?>
          <input type="hidden" name="token"
            value="<?php echo $_SESSION['CSRF_TOKEN']; ?>" />
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Sign in</button>
      </div>
    </div>
  </fieldset>
</form>

