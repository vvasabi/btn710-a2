<?php
/**
 * Actual site.
 *
 * @author Brad Chen
 */

require_once 'Crypt/Blowfish.php';

$key = 'btn710@G#';

ob_start();
include dirname(__FILE__) . '/content.php';
$content = ob_get_clean();
$bf = new Crypt_Blowfish($key);
$encrypted = bin2hex($bf->encrypt($key . $content));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <title>BTN720 Assignment 2—CSRF</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="blowfish.js"></script>
    <script type="text/javascript">
    jQuery(function() {
      var container = jQuery('#content');
      var key = prompt('Please enter the password.');
      if (!key) {
        container.append('<h1>Access Denied</h1>'
          + '<p>No password has been entered. '
          + 'No content shall be revealed.</p>');
        return;
      }
      var bf = new Blowfish(key);
      var decrypted = bf.decrypt('<?php echo $encrypted; ?>');
      var keyLength = key.length;
      if (decrypted.substring(0, keyLength) != key) {
        container.append('<h1>Access Denied</h1>'
          + '<p>Incorrect password has been entered. '
          + 'No content shall be revealed.</p>');
        return;
      }
      container.append(decrypted.substring(keyLength));
    });
    </script>

    <link rel="stylesheet" href="midnight/stylesheets/styles.css">
    <link rel="stylesheet" href="midnight/stylesheets/pygment_trac.css">
    <script src="midnight/javascripts/respond.js"></script>
    <!--[if lt IE 9]>
      <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
    <link rel="stylesheet" href="midnight/stylesheets/ie.css">
    <![endif]-->
  </head>
  <body>
    <div class="wrapper">
      <section>
        <div id="title">
          <h1>BTN720 Assignment 2&mdash;CSRF</h1>
          <p>Brad Chen &bull; Andrei Kopytov</p>
        </div>
        <div id="content"></div>
      </section>

      <footer class="clear-block">
        <span class="credits right">Midnight theme by <a href="http://twitter.com/#!/michigangraham">mattgraham</a></span>
      </footer>
    </div>

    <!--[if !IE]><script>fixScale(document);</script><!--<![endif]-->
  </body>
</html>
