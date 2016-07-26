<?php
require 'dbconfig.php';
$jsondata = array();
$email = $_POST['email'];
$password = $_POST['pwd'];
$sql = "SELECT * FROM $tbl_name WHERE email = '$email'";
$result = $connection->query($sql);
if ($result->num_rows == 0) {
    $jsondata['message'] = 'Cuenta aún no registrada';
} else {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if (password_verify($password, $row['password'])) {
        $jsondata['id']      = $row['id'];
        $jsondata['email']   = $row['email'];
        $jsondata['message'] = 'Sesión iniciada';
    } else {
        $jsondata['message'] = 'Contraseña incorrecta';
    }
}
echo json_encode($jsondata);
mysqli_close($connection);