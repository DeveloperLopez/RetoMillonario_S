<?php
require 'dbconfig.php';
$email = $_POST['email'];
$password = $_POST['pwd'];
$name = $_POST['name'];
$pwd = password_hash($password, PASSWORD_BCRYPT);
$jsondata = array();

$searchUser = "SELECT * FROM $tbl_name WHERE email = '$email' ";
$result = $connection->query($searchUser);
$count = mysqli_num_rows($result);

if ($count == 1) {
    $jsondata['message'] = 'Sesión iniciada';
    $jsondata['id']      = $row['id'];
    $jsondata['email']   = $row['email'];
} else {
    $query = "INSERT INTO $tbl_name (email, password, name) VALUES ('$email', '$pwd', '$name')";
    if ($connection->query($query) === TRUE) {
        $jsondata['id']      = $row['id'];
        $jsondata['email']   = $row['email'];
        $jsondata['message'] = 'Sesión iniciada, bienvenido';
    } else {
        $jsondata['message'] = "Error al crear el usuario." . $query . "<br>" . $connection->error;
    }
}
echo json_encode($jsondata);
mysqli_close($connection);