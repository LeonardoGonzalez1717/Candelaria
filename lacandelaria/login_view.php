<?php 
session_start();
require_once 'model/conexion.php';

if (!empty($_POST["cargo"]) && !empty($_POST["password"]) && !empty($_POST['nombre'])) {
    $alertas = array();
    //validar nombre
    if (isset($_POST["nombre"]) && is_string($_POST["nombre"]) && !preg_match("/[0-9]/", $_POST["nombre"])) {
        $nombre = trim($_POST["nombre"]);
        $nombre_limpio =trim($nombre);
        $nombre_escapado = mysqli_escape_string($db, $nombre_limpio);
    }else{
        $alertas['nombre'] = 'Por favor introducir un nombre valido';
        
    }
    
    //Validar usuario
    if (isset($_POST["cargo"]) && is_string($_POST["cargo"]) && !preg_match("/[0-9]/", $_POST["cargo"])) {
        $cargo = trim($_POST["cargo"]);
        $cargo_escapado = mysqli_escape_string($db, $cargo);
    }else{
        $alertas['cargo'] = 'Por favor introducir un cargo valido';
        
    }
    //Validar COntraseña
    if (isset($_POST["password"]) && preg_match("/[a-zA-Z]/", $_POST["password"]) && preg_match("/[0-9]/", $_POST["password"])){
        $password = trim($_POST["password"]);
        $password_escapado = mysqli_escape_string($db, $password);
        //encriptado
        $encode = base64_encode($password_escapado);
        var_dump($encode);
    }else{
        $alertas['password'] = 'Por favor introducir una password valida';
        
    }
    if (count($alertas) == 0) {
        
        $sql = "select * from usuarios where nombre = '$nombre_escapado' and cargo = '$cargo_escapado' and password = '$encode'";
        $guardar = mysqli_query($db, $sql);
        if ($guardar == true && mysqli_num_rows($guardar) > 0) {
            $usuario = mysqli_fetch_assoc($guardar);
            
        if($usuario['id_rol'] == 1){
            $_SESSION['usuario_admin'] = $usuario; 
            header('location: index.php');

        }elseif($usuario['id_rol'] == 2){
            $_SESSION['usuario_lector'] = $usuario;
            header('location: index.php');
        }
    }else{
        $_SESSION['alerta'] = 'Usuario desconocido';
        header('location: login_form.php');
        
    }
}else{
    $_SESSION['alertas'] = $alertas;
         header('location: login_form.php');
}
}else{
    $_SESSION['alerta'] = 'Error al iniciar sesion';
    header('location: login_form.php');

}

?>