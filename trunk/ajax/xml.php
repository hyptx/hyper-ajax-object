<?php
header("Content-Type: text/xml");
$xml = '<?xml version="1.0" encoding="iso-8859-1"?>';


$xml .= '<test>';
$xml .= '<first>First</first><br />';
$xml .= '<second>Second</second><br />';
$xml .= '<third>Third</third><br />';
$xml .= '<inner>';
$xml .= '<value>Inner Value</value>';
$xml .= '</inner>';
$xml .= '</test>';

echo $xml;
?>