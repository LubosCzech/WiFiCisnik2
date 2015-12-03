<?php
/**
 * Created by PhpStorm.
 * User: lubossvetik
 * Date: 03.12.15
 * Time: 14:45
 */

require_once ("phpwee.php");

$custom_css = file_get_contents(getcwd().'/webroot/css/custom.css');
$minified_css = PHPWee\Minify::css($custom_css);
file_put_contents(getcwd().'/webroot/css/custom.min.css',$minified_css);
