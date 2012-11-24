<?php
/**
 * Display the data and provide delete function.
 *
 * @author Brad Chen
 */

if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  if (isset($_SESSION['users'][$id])) {
    unset($_SESSION['users'][$id]);
    $_SESSION['MESSAGE'] = '<strong>Success!</strong> '
      . 'The user has been deleted.';
  } else {
    $_SESSION['ERROR'] = '<strong>Error!</strong> '
      . 'The user could not be found.';
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit(0);
}
?>
<script type="text/javascript">
// <![CDATA[
jQuery(function() {
  jQuery('button.remove').click(function() {
    var id = jQuery(this).data('id');
    window.location = '<?php echo $_SERVER['PHP_SELF']; ?>?delete=' + id;
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
        <td><?php echo $user['login']; ?></td>
        <td><?php echo $user['password']; ?></td>
        <td>
          <button class="btn remove" data-id="<?php echo $i; ?>"><i
            class="icon-remove"></i> Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

