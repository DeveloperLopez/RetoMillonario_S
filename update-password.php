<?php
require 'dbconfig.php';
$id = $_POST['id'];
$password = $_POST['pwd'];
$new_password = password_hash($password, PASSWORD_BCRYPT);
// For send data to Ajax query
$jsondata = array();
// Search user fo update password
$query = "UPDATE $db_name.$tbl_name SET password = '$new_password' WHERE users.id ='$id'";
if ($connection->query($query) === TRUE) {
    $jsondata['message'] = 'Contraseña actualizada';
} else {
    $jsondata['message'] = "Error al actualiZar." . $query . "<br>" . $connection->error;
}
// Return data
echo json_encode($jsondata);
mysqli_close($connection);