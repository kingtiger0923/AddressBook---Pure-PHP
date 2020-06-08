<?php

function openDB($conf)
{
  $conn = mysqli_connect($conf['host'], $conf['userName'], $conf['password'], $conf['dbName']);

  return $conn;
}

function closeDB($conn) {
  $conn->close();
}

?>