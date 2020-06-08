<?php
include "../dataBase/db_con.php";
$config = include "../config.php"; //dataBase Config

// Open DB
$conn = openDB($config);

$query_res = mysqli_query($conn, 'SELECT a.*, c.cityName FROM addr_entries a LEFT JOIN addr_cities c ON a.city = c.id');

$xml = "<AddressBook>";

while($rc = mysqli_fetch_assoc($query_res)) {
  $xml .= "<Address name='".$rc['name']."' firstName='".$rc['firstName']."' Email='".$rc['email']."' Street='".$rc['street']."' ZipCode='".$rc['zip_code']."' City='".$rc['cityName']."' />";
}

$xml .= "</AddressBook>";

// Close DB
closeDB($conn);

$sxe = new SimpleXMLElement($xml);
$dom = new DOMDocument('1,0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($sxe->asXML());
$data =  $dom->saveXML();

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
header("Content-Transfer-Encoding: binary;\n");
header("Content-Disposition: attachment; filename=\"filename.xml\";\n");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");
header("Content-Length: ".strlen($data).";\n");
echo $data;

die;
?>