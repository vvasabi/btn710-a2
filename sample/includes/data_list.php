<h2>List of Users</h2>
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Login</th>
      <th>Password</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($_SESSION['users'] as $i => $user) : ?> 
      <tr>
        <td><?php echo $i + 1; ?></td>
        <td><?php echo $user['login']; ?></td>
        <td><?php echo $user['password']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

