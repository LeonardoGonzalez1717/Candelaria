<?php 
require 'model/conexion.php';
session_start();
if (isset($_POST['codigo'])){
    //edicion de estudiantes
$codigo = $_POST['codigo'];
$ano = $_POST['ano'];

$url = "estudiantes.php";
$url .= "?id=" . urldecode($ano);
$alertas = array();

if (!empty($codigo) && !empty($ano)) {  
    if (isset($_POST["Nombre"]) && !is_numeric($_POST["Nombre"]) && !preg_match("/[0-9]/", $_POST["Nombre"])) {
        $Nombre= trim($_POST["Nombre"]);
        $nombre_escapado =  mysqli_real_escape_string($db, $Nombre);
    }else {
        $alertas['nombre'] = 'El nombre debe  llevar unicamente letras';
    }
    if (isset($_POST["apellido"]) && !is_numeric($_POST["apellido"]) && !preg_match("/[0-9]/", $_POST["apellido"])) {
        $apellido = trim($_POST["apellido"]);
        $apellido_escapado =  mysqli_real_escape_string($db, $apellido);
    }else {
        $alertas['apellido'] = 'El apellido debe  llevar unicamente letras';
    }
    if (isset($_POST["cedula"]) && is_numeric($_POST["cedula"]) && !preg_match("/[a-zA-Z]/", $_POST["cedula"])) {
        $cedula= trim($_POST["cedula"]);
        $cedula_escapado =  mysqli_real_escape_string($db, $cedula);
    }else{
        $alertas['cedula'] = 'Cedula invalida';
    }
    if (isset($_POST["edad"]) && is_numeric($_POST["edad"]) && !preg_match("/[a-zA-Z]/", $_POST["edad"])) {
        $edad=trim($_POST["edad"]);
        $edad_escapado =  mysqli_real_escape_string($db, $edad);
    }else{
        $alertas['edad'] = 'edad invalida';
    }
    if (isset($_POST["ano"]) && is_numeric($_POST["ano"]) && !preg_match("/[a-zA-Z]/", $_POST["ano"])) {
        $ano= $_POST["ano"];
        $ano_escapado =  mysqli_real_escape_string($db, $ano);
    }else{
        $alertas['ano'] = 'Año invalido';
    }
    

    if (count($alertas) == 0) {
        
        $sql = "UPDATE cursando join alumno on cursando.id_alumno = alumno.id SET alumno.nombre = '$nombre_escapado', alumno.apellido = '$apellido_escapado', alumno.cedula = '$cedula', alumno.edad = '$edad_escapado', cursando.id_ano = '$ano' where cursando.id_cu = $codigo;";
        $guardar = mysqli_query($db, $sql);
        if ($guardar == true) {
            $_SESSION['guardado']['exito'] = 'Usuario editado con exito';
            header('location: '. $url);
        }else{
            $_SESSION['guardado']['error'] = 'Error al registrar usuario';
            header('location: '. $url);
        }
    }else{
        $url_error = "editar_form.php";
        $url_error .= "?codigo=" . urldecode($codigo);
        $_SESSION['alertas'] = $alertas;
        header('location: '. $url_error);
    }



}else{
    echo 'error2';
}
//edicion de usuario
}elseif(!empty($_POST['nombre']) ||  !empty($_POST['cargo'])) {
    if (isset($_POST['nombre'])  && isset($_POST['cargo']) ){
        
        $id_usuario = $_POST['id'];
        $url = "editar_usuario.php";
        $url .= "?usuario=" . urlencode($id_usuario);

    $id_cargo = $_POST['id_cargo'];
    $alertas = array();
    
    
    if (isset($_POST["nombre"]) && !is_numeric($_POST["nombre"]) && !preg_match("/[0-9]/", $_POST["nombre"])) {
        $nombre= trim($_POST["nombre"]);
        $nombre_escapado =  mysqli_real_escape_string($db, $nombre);
    }else {
        $alertas['nombre'] = 'el nombre debe  llevar unicamente letras';
    }
  
    if (isset($_POST["cargo"]) && !is_numeric($_POST["cargo"]) && !preg_match("/[0-9]/", $_POST["cargo"])) {
        $cargo= trim($_POST["cargo"]);
        $cargo_escapado =  mysqli_real_escape_string($db, $cargo);
    }else {
        $alertas['cargo'] = 'el cargo debe  llevar unicamente letras';
    }


    if (count($alertas) == 0) {
        
        $sql = "update usuarios set nombre = '$nombre_escapado', cargo = '$cargo_escapado', id_rol = '$id_cargo' where id = $id_usuario";
        $guardar = mysqli_query($db, $sql);
        if ($guardar) {
            $_SESSION['guardado'] = 'Guardado con exito';
            header('location: admin.php');
            exit();
        }else{
            $_SESSION['alerta']['usuario'] = 'error al guardar';
            header('Location: admin.php');
        }
    }else{
        $_SESSION['alertas'] = $alertas;
        header('location: '. $url);
    }
    
}else{
    echo 'vaciooo';
}
    
    
}else{

    echo 'Vacio1';
}


?>