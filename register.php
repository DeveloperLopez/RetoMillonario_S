<?php
require 'dbconfig.php';
$email    = $_POST['email'];
$password = $_POST['pwd'];
$pwd = password_hash($password, PASSWORD_BCRYPT);
$searchUser = "SELECT * FROM $tbl_name WHERE email = '$email' ";
$result = $connection->query($searchUser);
$count = mysqli_num_rows($result);
if ($count == 1) {
    echo 'Esta cuenta ya ha sido registrada.';
} else {
    $query = "INSERT INTO $tbl_name (email, password) VALUES ('$email', '$pwd')";
    if ($connection->query($query) === TRUE) {
        echo 'Cuenta creada exitosamente';
    } else {
        echo "Error al crear el usuario." . $query . "<br>" . $connection->error;
    }
}
mysqli_close($connection);