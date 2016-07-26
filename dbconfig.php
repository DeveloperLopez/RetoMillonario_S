<?php
$host_db = "localhost";
$user_db = "hpdsbmbj_reto";
$pass_db = "kh)xBOQOC^MJ";
$db_name = "hpdsbmbj_reto";
$tbl_name = "users";

$connection = new mysqli($host_db, $user_db, $pass_db, $db_name);
if ($connection->connect_error) {
    die("La conexión falló: " . $connection->connect_error);
}