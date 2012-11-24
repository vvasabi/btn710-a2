<?php
/**
 * This is a sample script that demonstrates CSRF vulnerability.
 *
 * @author Brad Chen
 */

define('BASE_PATH', dirname(__FILE__));
?>
<?php include BASE_PATH . '/includes/header.php'; ?>
<?php if (isset($_SESSION['LOGGED_IN'])) : ?>
  <?php include BASE_PATH . '/includes/data_list.php'; ?>
  <?php include BASE_PATH . '/includes/insert_form.php'; ?>
<?php else : ?>
  <?php include BASE_PATH . '/includes/login_form.php'; ?>
<?php endif; ?>
<?php include BASE_PATH . '/includes/footer.php'; ?>
