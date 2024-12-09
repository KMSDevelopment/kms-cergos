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
?>
