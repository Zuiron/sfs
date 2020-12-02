<?php
#error_reporting(E_ALL);
error_reporting(0);
#ini_set('error_reporting', E_ALL);

function parse_path() {
  $path = array();
  if (isset($_SERVER['REQUEST_URI'])) {
    $request_path = explode('?', $_SERVER['REQUEST_URI']);

    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    $path['call'] = utf8_decode($path['call_utf8']);
    if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
      $path['call'] = '';
    }
    $path['call_parts'] = explode('/', $path['call']);

    $path['query_utf8'] = urldecode($request_path[1]);
    $path['query'] = utf8_decode(urldecode($request_path[1]));
    $vars = explode('&', $path['query']);
    foreach ($vars as $var) {
      $t = explode('=', $var);
      $path['query_vars'][$t[0]] = $t[1];
    }
  }
return $path;
}

$path_info = parse_path();

require_once("header.php");

$url_path = $path_info['call_parts'];
if($url_path[0] == "") {
	require_once("main.php"); ?>
    <script>document.getElementById('home').setAttribute('class', 'active');</script>
    <?php
}
else if($url_path[0] == "kompetansebevis") {
	require_once("pages/kompetansebevis.php");
}
else if($url_path[0] == "reginn") {
	require_once("pages/reginn.php");
}
else if($url_path[0] == "maskinregisteret") {
	require_once("pages/maskinregister.php");
}
else if($url_path[0] == "mistetbevis") {
	require_once("pages/mistetbevis.php");
}
else if($url_path[0] == "skjema") {
	require_once("pages/skjema.php");
}
else if($url_path[0] == "ressurser") {
	require_once("pages/ressurser.php");
}
else if($url_path[0] == "omoss") {
	require_once("pages/omoss.php");
}
else {
	require_once("pages/404.php");
}
?> <script>document.getElementById('<?php echo $url_path[0]; ?>').setAttribute('class', 'active');</script> <?php

require_once("footer.php");

?>
