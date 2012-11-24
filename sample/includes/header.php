<?php
/**
 * Page header.
 *
 * @author Brad Chen
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <?php if (isset($_SESSION['CSRF_PROTECTION'])) : ?>
      <title>A Secure Data Entry Site Protected Against CSRF</title>
    <?php else : ?>
      <title>A Naïve Data Entry Site</title>
    <?php endif; ?>
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
          <div class="pull-right">
            <?php if (preg_match('/\/index\.php$/', $_SERVER['PHP_SELF'])) : ?>
              <strong>Home</strong>
            <?php else : ?>
              <a href="index.php">Home</a>
            <?php endif; ?> |

            <?php if (preg_match('/\/setting\.php$/', $_SERVER['PHP_SELF'])) : ?>
              <strong>Setting</strong>
            <?php else : ?>
              <a href="setting.php">Setting</a>
            <?php endif; ?> |

            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout">Log out</a>
          </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['CSRF_PROTECTION'])) : ?>
          <h1>A Secure Data Entry Site</h1>
        <?php else : ?>
          <h1>A Naïve Data Entry Site</h1>
        <?php endif; ?>
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
