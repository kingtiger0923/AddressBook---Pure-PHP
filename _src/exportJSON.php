<?php
include "../dataBase/db_con.php";
$config = include "../config.php"; //dataBase Config

// Open DB
$conn = openDB($config);

$query_res = mysqli_query($conn, 'SELECT * FROM addr_entries');
$json_array = [];

while($rc = mysqli_fetch_assoc($query_res)) {
  $json_array[] = $rc;
}

// Close DB
closeDB($conn);

$data = json_encode($json_array);

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
header("Content-Transfer-Encoding: binary;\n");
header("Content-Disposition: attachment; filename=\"filename.json\";\n");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");
header("Content-Length: ".strlen($data).";\n");
echo $data;

die;
?>