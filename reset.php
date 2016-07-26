<?php
require 'dbconfig.php';
$email = $_POST['email'];
$password = randomPassword();
$new_password = password_hash($password, PASSWORD_BCRYPT);

$sql = "SELECT * FROM $tbl_name WHERE email = '$email'";
$result = $connection->query($sql);
$count = mysqli_num_rows($result);
if ($count != 1) {
    echo "La cuenta no existe.";
} else {
    $query = "UPDATE $db_name.$tbl_name SET password = '$new_password' WHERE users.email ='$email'";
    if ($connection->query($query) === TRUE) {
        // Start format of mail
        $title = "Contraseña restaurada";
        $mail = "Su nueva contraseña es: $password";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: Reto millonario < fernando@developerlopez.com >\r\n";
        // End format of mail
        mail($email,$title,$mail,$headers);
        echo "Hemos enviado tu nueva contraseña a $email";
    } else {
        echo "Error al reiniciar." . $query . "<br>" . $connection->error;
    }
}
// Generate random password
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
mysqli_close($connection);