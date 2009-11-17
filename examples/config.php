<?PHP

$shell['title1'] = "JavaScript Linkify";
$shell['link1']  = "http://benalman.com/projects/javascript-linkify/";

ob_start();
?>
  <a href="http://benalman.com/projects/javascript-linkify/">Project Home</a>,
  <a href="http://benalman.com/code/projects/javascript-linkify/docs/">Documentation</a>,
  <a href="http://github.com/cowboy/javascript-linkify/">Source</a>
<?
$shell['h3'] = ob_get_contents();
ob_end_clean();

$shell['jquery'] = 'jquery-1.3.2.js';

$shell['shBrush'] = array( 'JScript' );

?>
