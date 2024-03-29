<?php
/**
 * Display the data and provide delete function.
 *
 * @author Brad Chen
 */

if (isset($_GET['delete'])) {
  check_csrf_attack(isset($_GET['token']) ? $_GET['token'] : null);

  $login = $_GET['delete'];
  $found = false;
  foreach ($_SESSION['users'] as $i => $user) {
    if ($user['login'] == $login) {
      unset($_SESSION['users'][$i]);
      $_SESSION['MESSAGE'] = '<strong>Success!</strong> '
        . 'The user has been deleted.';
      $found = true;
      break;
    }
  }
  if (!$found) {
    $_SESSION['ERROR'] = '<strong>Error!</strong> '
      . 'The user could not be found.';
  }

  generate_csrf_token();
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit(0);
}
?>
<script type="text/javascript">
// <![CDATA[
jQuery(function() {
  jQuery('button.remove').click(function() {
    var login = jQuery(this).data('login');
    if (jQuery('input[name="token"]').size()) {
      var token = jQuery('input[name="token"]').val();
      window.location = '<?php echo $_SERVER['PHP_SELF']; ?>?delete=' + login 
        + '&token=' + token;
    } else {
      window.location = '<?php echo $_SERVER['PHP_SELF']; ?>?delete=' + login;
    }
  });
});
// ]]>
</script>
<h2>List of Users</h2>
<table class="table table-striped">
  <thead>
    <tr>
      <th style="width: 8%;">#</th>
      <th style="width: 40%;">Login</th>
      <th style="width: 40%;">Password</th>
      <td></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($_SESSION['users'] as $i => $user) : ?> 
      <tr>
        <td><?php echo $i + 1; ?></td>
        <td><?php echo htmlspecialchars($user['login']); ?></td>
        <td><?php echo htmlspecialchars($user['password']); ?></td>
        <td>
          <button class="btn remove"
            data-login="<?php echo urlencode($user['login']); ?>"><i
            class="icon-remove"></i> Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

