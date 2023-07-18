<?php 
//Conexion a la base de datos
require_once 'model/conexion.php';
session_start();
$alertas = array();

//Validacion de datos, registrando los datos q se envien del formulario atraves del $_POST, con el "Name" del formulario.
    if(!empty($_POST["nombre"]) || !empty($_POST["apellido"]) || !empty($_POST["cedula"]) || !empty($_POST["edad"])) {  

//Validacion de formulario
//nombre 
if (isset($_POST["nombre"]) && !is_numeric($_POST["nombre"]) && !preg_match("/[0-9]/", $_POST["nombre"])) {
    $nombre=$_POST["nombre"];
    $nombre_escapado=  mysqli_real_escape_string($db, $nombre);
}else{
 
    $alertas['nombre'] = 'Nombre Erroneo, Verificarlo';
  
}
//apellido
if (isset($_POST["apellido"]) && !is_numeric($_POST["apellido"]) && !preg_match("/[0-9]/", $_POST["apellido"])) {
    $apellido=$_POST["apellido"];
    $apellido_escapado =  mysqli_real_escape_string($db, $apellido);
}else{
 
    $alertas['apellido'] = 'Apellido Erroneo, Verificarlo';
  
}
//cedula
if (isset($_POST["cedula"]) && is_numeric($_POST["cedula"]) && preg_match("/[0-9]/", $_POST["cedula"])) {
    $cedula= $_POST["cedula"];
    $cedula_escapado =  mysqli_real_escape_string($db, $cedula);
}else{
    $alertas['cedula'] = 'Cedula Erronea, Verificarla';
   
}

if (isset($_POST['edad']) || is_numeric($_POST['edad']) || preg_match("/[0-9]/", $_POST["edad"])) {
    $edad = $_POST['edad'];
    $edad_escapado = mysqli_real_escape_string($db, $edad);
}else {
    $alertas['edad'] = 'Verificar la edad';
   
}

if (count($alertas) == 0) {
    //vinculando los datos que nos lleguen del formulario a la base de datos
    $sql = "insert into alumno values(null, '$nombre_escapado', '$apellido_escapado', '$cedula_escapado', '$edad_escapado')";
    $guardar = mysqli_query($db, $sql);
    

   if ($guardar == true) {
    $_SESSION['alerta'] = 'Usuario registrado con exito';
    header('location: registrar_form.php');
    exit();
    
   }else {
    $_SESSION['alerta'] = 'Error al registrar Usuario';
    header('location: registrar_form.php');
    exit();
   }
 
    
}else {
    $_SESSION['alertas'] = $alertas;
    header('location: registrar_form.php');
}
}else{
    echo 'error'; 
}
?>