<?php
$i_servername = "localhost";
$i_username = "root";
$i_password = "";
$i_dbname = "kms_db";
// Create connection
$i_conn = mysqli_connect($i_servername, $i_username, $i_password, $i_dbname);

// Check connection
if (!$i_conn) {
  die("KB DB Connection failed: " . mysqli_connect_error());
}

$mgr_api = "1x!U1!Ma.aAzx3X@7ft|3rEW9=R8@t@^C5v^7HFNAgCt";
?>
