<?php
require 'dbconfig.php';
$id = $_POST['id'];
$path = 'img/' . $id . '.jpg';
// For send data to Ajax query
$query = "UPDATE $db_name.$tbl_name SET photo = '1' WHERE users.id ='$id'";
if ($connection->query($query) === TRUE) {
    ///
}
move_uploaded_file($_FILES["file"]["tmp_name"], $path);