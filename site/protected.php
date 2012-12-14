<?php
/**
 * Actual site.
 *
 * @author Brad Chen
 */

$passphrase = 'btn710@G#';
$iv = md5(rand(pow(10, 6), getrandmax()), true);
$key = pbkdf2('sha256', $passphrase, $iv, 1024, 32, true);

ob_start();
include dirname(__FILE__) . '/content.php';
$content = ob_get_clean();
$encrypted = openssl_encrypt($content, 'aes-256-cbc', $key, true, $iv);
$checksum = md5($content);

/**
 * PBKDF2 Function
 *
 * Source: http://php.net/manual/en/function.hash-hmac.php
 */
function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false) {
    $algorithm = strtolower($algorithm);
    if(!in_array($algorithm, hash_algos(), true))
        die('PBKDF2 ERROR: Invalid hash algorithm.');
    if($count <= 0 || $key_length <= 0)
        die('PBKDF2 ERROR: Invalid parameters.');

    $hash_length = strlen(hash($algorithm, "", true));
    $block_count = ceil($key_length / $hash_length);

    $output = "";
    for($i = 1; $i <= $block_count; $i++) {
        // $i encoded as 4 bytes, big endian.
        $last = $salt . pack("N", $i);
        // first iteration
        $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
        // perform the other $count - 1 iterations
        for ($j = 1; $j < $count; $j++) {
            $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
        }
        $output .= $xorsum;
    }

    if($raw_output)
        return substr($output, 0, $key_length);
    else
        return bin2hex(substr($output, 0, $key_length));
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <title>BTN720 Assignment 2—CSRF</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="crypto-js-3.0.2/components/core-min.js"></script>
    <script type="text/javascript" src="crypto-js-3.0.2/components/enc-base64-min.js"></script>
    <script type="text/javascript" src="crypto-js-3.0.2/rollups/sha256.js"></script>
    <script type="text/javascript" src="crypto-js-3.0.2/rollups/pbkdf2.js"></script>
    <script type="text/javascript" src="crypto-js-3.0.2/rollups/aes.js"></script>
    <script type="text/javascript">
    jQuery(function() {
      var container = jQuery('#content');
      var passphrase = prompt('Please enter the password.', '');
      if (!passphrase) {
        container.append('<h1>Access Denied</h1>'
          + '<p>No password has been entered. '
          + 'No content shall be revealed.</p>');
        return;
      }
      var encrypted = '<?php echo base64_encode($encrypted); ?>';
      var iv = CryptoJS.enc.Base64.parse('<?php echo base64_encode($iv); ?>');
      var key = CryptoJS.PBKDF2(passphrase, iv, {
        keySize: 256/32,
        iterations: 1024,
        hasher: CryptoJS.algo.SHA256
      });
      var checksum = '<?php echo $checksum; ?>';
      var decrypted = CryptoJS.AES.decrypt(encrypted, key, {
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7,
        iv: iv
      });
      var decryptedString = null;
      try {
        if (decrypted.sigBytes > 0) {
          decryptedString = decrypted.toString(CryptoJS.enc.Utf8);
        }
      } catch (e) {
        // do nothing
      }
      if (!decryptedString) {
        container.append('<h1>Access Denied</h1>'
          + '<p>Incorrect password has been entered. '
          + 'No content shall be revealed.</p>');
        return;
      }

      var decryptedString = decrypted.toString(CryptoJS.enc.Utf8);
      var decryptedChecksum = CryptoJS.MD5(decryptedString).toString();
      if (decryptedChecksum != checksum) {
        container.append('<h1>Decryption Failed</h1>'
          + '<p>Verifying content using checksum failed. '
          + 'No content shall be revealed.</p>');
        return;
      }
      container.append(decryptedString);
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
