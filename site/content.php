<?php
/**
 * Content for the BTN720 Research Website.
 *
 * @author Brad Chen
 */

$base_path = dirname(__FILE__);
$content = $base_path . '/content.md';
if (file_exists('/usr/local/bin/redcarpet')) {
  passthru('/usr/local/bin/redcarpet ' . $content);
} else {
  passthru('/usr/bin/env redcarpet ' . $content);
}

