<?php 
include_once 'model/conexion.php';
session_start();


if (isset($_POST) && !empty($_POST)) {
    $estudiante =$_POST['estudiante'];
    $ano=$_POST['ano'];  
    $periodo = $_SESSION['periodos']['id'];
    $errores=array();




} 
if (count($errores) == 0) {
    
    $sql = "insert into cursando values(null, '$estudiante', '$ano', '$periodo')";
    $guardar = mysqli_query($db, $sql);
    
    if ($guardar == true) {
        $_SESSION['Usuario']['exito'] = 'Usuario registrado con exito';
        header('location:  administrar_E.php');
        exit();
    
    }else {
        $_SESSION['Usuario']['error'] = 'Error al registrar Usuario';
        header('location:  administrar_E.php');
        exit();
    }
}else{
    $_SESSION['alertas'] = $errores;
    header("location: administrar_E.php");
    exit;

}

?>