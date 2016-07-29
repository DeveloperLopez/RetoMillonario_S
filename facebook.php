<?php
require 'dbconfig.php';

$email = $_POST['email'];
$password = $_POST['pwd'];
$name = $_POST['name'];
$pwd = password_hash($password, PASSWORD_BCRYPT);
$id_facebook = $_POST['pwd'];
$jsondata = array();

$searchUser = "SELECT * FROM $tbl_name WHERE email = '$email' OR id_facebook = '$id_facebook'";
$result = $connection->query($searchUser);
$count = mysqli_num_rows($result);

if ($count == 1) {

    $sql = "SELECT * FROM $tbl_name WHERE email = '$email' OR id_facebook = '$id_facebook'";
    $result = $connection->query($sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $jsondata['id_facebook'] = $row['id_facebook'];
    $jsondata['message'] = 'Sesión iniciada';
    $jsondata['id']      = $row['id'];
    $jsondata['email']   = $row['email'];
    $jsondata['photo']   = $row['photo'];
} else {
    $query = "INSERT INTO $tbl_name (email, password, name, id_facebook) VALUES ('$email', '$pwd', '$name', '$id_facebook')";
    if ($connection->query($query) === TRUE) {
        $sql = "SELECT * FROM $tbl_name WHERE id_facebook = '$id_facebook'";
        $result = $connection->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $jsondata['id_facebook'] = $row['id_facebook'];
        $jsondata['id']      = $row['id'];
        $jsondata['email']   = $row['email'];
        $jsondata['photo']   = $row['photo'];
        $jsondata['message'] = 'Sesión iniciada';
    } else {
        $jsondata['message'] = "Error al crear el usuario." . $query . "<br>" . $connection->error;
    }
}
echo json_encode($jsondata);
mysqli_close($connection);