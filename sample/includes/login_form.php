<?php
/**
 * Form for logging in.
 *
 * @author Brad Chen
 */

if ($_POST) {
  if (($_POST['login'] != 'btn710') || ($_POST['password'] != 'btn710')) {
    $_SESSION['ERROR'] = '<strong>Unable to log in</strong>. Please try again.';
  } else {
    $_SESSION['MESSAGE'] = '<strong>Hello!</strong> Logged in successfully.';
    $_SESSION['LOGGED_IN'] = true;
  }

  header('Location: ' . $_SERVER['PHP_SELF']);
  exit(0);
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
        <button type="submit" class="btn btn-primary">Sign in</button>
      </div>
    </div>
  </fieldset>
</form>

