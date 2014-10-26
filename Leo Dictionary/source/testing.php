<?php
require('leo.php');

$in = "testen";
$leo = new Leo("ende");
echo $leo->getTranslations($in);	
?>