<?php
/**
 * Created by PhpStorm.
 * User: lubossvetik
 * Date: 03.12.15
 * Time: 14:45
 */

require_once ('phpwee.php');

$custom_css = file_get_contents(getcwd().'/webroot/css/custom.css');
$minified_css = PHPWee\Minify::css($custom_css);
file_put_contents(getcwd().'/webroot/css/custom.min.css',$minified_css);


$autorefresh = file_get_contents(getcwd().'/webroot/js/autorefresh.js');
$minified_js = PHPWee\Minify::js($autorefresh);
file_put_contents(getcwd().'/webroot/js/autorefresh.min.js',$minified_js);


$default = file_get_contents(getcwd().'/src/Template/Layout/default.ctp');
$str=str_replace("autorefresh.js", "autorefresh.min.js",$default);
file_put_contents(getcwd().'/src/Template/Layout/default.ctp',$str);





