<?php
require 'dbconfig.php';
$id = $_POST['id'];
// For send data to Ajax query
$jsondata = array();
// Require data for store on JSON
$sql = "SELECT * FROM $tbl_name WHERE id = '$id'";
$result = $connection->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$jsondata['name']      = $row['name'];
$jsondata['born']      = $row['born'];
$jsondata['dni']       = $row['dni'];
$jsondata['email']     = $row['email'];
$jsondata['tel']       = $row['tel'];
$jsondata['dep']       = $row['dep'];
$jsondata['city']      = $row['city'];
$jsondata['id']        = $row['id'];
// Return data
echo json_encode($jsondata);
mysqli_close($connection);