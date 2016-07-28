<?php
require 'dbconfig.php';

// receives all data form
$id       = check_input($_POST['id'],    "El campo ID es obligatorio.");
$name     = check_input($_POST['name'],  "El campo Nombre es obligatorio.");
$born     = check_input($_POST['born'],  "El campo Fecha de nacimiento es obligatorio.");
$dni      = check_input($_POST['dni'],   "El campo Número de identidad es obligatorio.");
$email    = check_input($_POST['email'], "El campo Correo electrónico es obligatorio.");
$tel      = check_input($_POST['tel'],   "El campo Teléfono es obligatorio.");
$dep      = check_input($_POST['dep'],   "El campo Departamento es obligatorio.");
$city     = check_input($_POST['city'],  "El campo Ciudad es obligatorio.");
// For send data to Ajax query
$jsondata = array();
// Verify correct email
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
    $jsondata['message'] = "Correo electrónico incorrecto";
} else {
    $searchUser = "SELECT * FROM $tbl_name WHERE id != '$id' AND email = '$email' ";
    $result = $connection->query($searchUser);
    $count = mysqli_num_rows($result);
    // Verify new email
    if ($count == 1) {
        $jsondata['message'] = "El correo electrónico ingresado ya está registrado.";
    } else {
        $sql = "UPDATE $db_name.$tbl_name SET email = '$email', name = '$name', born = '$born', dni = '$dni', tel = '$tel', dep = '$dep', city = '$city' WHERE users.id = '$id'";
        if ($connection->query($sql) === TRUE) {
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
            $jsondata['message'] = "Datos actualizados correctamente.";
        } else {
            $jsondata['message'] = "Error al actualizar." . $sql . "<br>" . $connection->error;
        }
    }
}
// Checks and clean correct data input
function check_input($data, $problem='') {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0) {
        $jsondata['message'] = $problem;
        echo json_encode($jsondata);
	    exit();
    }
    return $data;
}

echo json_encode($jsondata);
mysqli_close($connection);