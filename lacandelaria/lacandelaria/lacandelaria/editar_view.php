<?php 
require 'model/conexion.php';
if (isset($_POST['codigo'])) {;
session_start();

$codigo = $_POST['codigo'];
$nombre = $_POST['Nombre'];
$cedula = (int)$_POST['cedula'];
$apellido = $_POST['apellido'];
$ano = $_POST['ano'];
$edad = (int)$_POST['edad'];
$periodo = $_POST['periodo'];


if (!empty($codigo) && !empty($nombre) && !empty($cedula) && !empty($apellido) && !empty($edad) && !empty($ano) && !empty($periodo)) {
    $sql = "UPDATE cursando join alumno on cursando.id_alumno = alumno.id SET alumno.nombre = '$nombre', alumno.apellido = '$apellido', alumno.cedula = '$cedula', alumno.edad = '$edad', cursando.id_ano = '$ano', periodo = '$periodo' where cursando.id_cu = $codigo;";
    $guardar = mysqli_query($db, $sql);
    if ($guardar == true) {
        $_SESSION['guardado']['exito'] = 'Usuario registrado con exito';
        header('location: estudiantes.php');
    }else{
        $_SESSION['guardado']['error'] = 'Error al registrar usuario';
        header('location: estudiantes.php');
    }



}else{
    echo 'error2';
}

}


?>