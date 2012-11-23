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
    <title>BTN720 Assignment 2—CSRF</title>
    <script type="text/javascript" src="blowfish.js"></script>
    <script type="text/javascript">
    window.onload = function() {
      var key = prompt('Please enter the password.');
      if (!key) {
        alert('No key has been entered. No content shall be revealed.');
        return;
      }
      var bf = new Blowfish(key);
      var decrypted = bf.decrypt('<?php echo $encrypted; ?>');
      var keyLength = key.length;
      if (decrypted.substring(0, keyLength) != key) {
        alert('Incorrect key has been entered. No content shall be revealed.');
        return;
      }
      document.write(decrypted.substring(keyLength));
    }
    </script>
  </head>
  <body></body>
</html>
