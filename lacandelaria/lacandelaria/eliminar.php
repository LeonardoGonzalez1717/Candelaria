<?php 
session_start();
if (isset($_GET['codigo'])) {

require 'model/conexion.php';
$codigo = $_GET['codigo'];

$sql = ("DELETE FROM cursando where id = $codigo;");
$resultado = mysqli_query($db, $sql);

if ($resultado === TRUE) {
    $_SESSION['eliminado'] = 'Estudiante eliminado  con exito';
    header('location: estudiantes.php');
} else {
    $_SESSION['eliminado']['error'] = 'error al eliminar el estudiante' ;
    header('location: estudiantes.php');
}
}
?>
