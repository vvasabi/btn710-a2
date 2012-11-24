<?php
/**
 * This page is used to turn CSRF protection on.
 *
 * @author Brad Chen
 */

define('BASE_PATH', dirname(__FILE__));
include BASE_PATH . '/includes/common.php';

if (!isset($_SESSION['LOGGED_IN'])) {
  header('Location: index.php');
  exit(0);
}
if ($_POST) {
  $csrf_protection = $_POST['csrf-protection'];
  if ($csrf_protection == 'on') {
    $_SESSION['CSRF_PROTECTION'] = 'on';
  } else {
    unset($_SESSION['CSRF_PROTECTION']);
  }
  generate_csrf_token();
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit(0);
}
?>
<?php include BASE_PATH . '/includes/header.php'; ?>
<script type="text/javascript">
// <![CDATA[
jQuery(function() {
  jQuery('#csrf-on').click(function() {
    jQuery('#csrf-protection').val('off');
    jQuery('form').submit();
  });
  jQuery('#csrf-off').click(function() {
    jQuery('#csrf-protection').val('on');
    jQuery('form').submit();
  });
});
// ]]>
</script>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
    class="form-horizontal">
  <fieldset>
    <legend>Setting</legend>

    <div class="control-group">
      <label class="control-label">CSRF Protection</label>
      <div class="controls">
        <?php if (isset($_SESSION['CSRF_PROTECTION'])) : ?>
          <button id="csrf-on" class="btn btn-success" type="button">On</button>
        <?php else : ?>
          <button id="csrf-off" class="btn btn-danger"
            type="button">Off</button>
        <?php endif; ?>
        <?php if (isset($_SESSION['CSRF_PROTECTION'])) : ?>
          <input type="hidden" name="token"
            value="<?php echo $_SESSION['CSRF_TOKEN']; ?>" ?>
        <?php endif; ?>
        <input type="hidden" id="csrf-protection" name="csrf-protection" />
      </div>
    </div>
  </fieldset>
</form>
<?php include BASE_PATH . '/includes/footer.php'; ?>
