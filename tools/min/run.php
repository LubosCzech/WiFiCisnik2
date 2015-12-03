<?php
/**
 * Created by PhpStorm.
 * User: lubossvetik
 * Date: 03.12.15
 * Time: 14:45
 */

require_once ("phpwee.php");

print_r(glob("*.css"));
$custom_css = file_get_contents('./custom.css',true);
$minified_css = PHPWee\Minify::css($custom_css);
file_put_contents('./custom.min.css',$minified_css);
