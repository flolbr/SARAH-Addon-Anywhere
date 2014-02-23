<?php
$ip = "http://127.0.0.1";
$port = "8888";
$query = $_GET['q'];
// die(urldecode($query));
if (!$query) {
	die("Acune donnée reçue");
}
$url = $ip . ':' . $port . "/?emulate=" . $query;
// echo "URL: " . $url . "<br>\n" . "FGC: " . file_get_contents($url);
echo file_get_contents($url);
?>