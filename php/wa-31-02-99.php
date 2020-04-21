<?php
header("Content-type: application/xml: charset=UTF8");
$url = $_GET['url'];
$xml = file_get_contents($url);
print $xml;
 ?>
