<?php
/**
 * Content for the BTN720 Research Website.
 *
 * @author Brad Chen
 */

$base_path = dirname(__FILE__);
$content = $base_path . '/content.md';
passthru('/usr/local/bin/redcarpet ' . $content);

