<?php 
$contrasena = "";
$usuario = "root";
$nombre_bd = "bdcandelarian";

$db = new mysqli('localhost', "$usuario", "$contrasena", "$nombre_bd");

if ($db->connect_errno) {
    echo 'Error al conectar a la base de datos: ' . $db->connect_error;
    exit();
}
?>

