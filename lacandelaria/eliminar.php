<?php 
session_start();
require 'model/conexion.php';
//borrar estudiantes
if (isset($_GET['codigo']) && $_GET['ano']) {

$codigo = $_GET['codigo'];
$ano = $_GET['ano'];

$url = "estudiantes.php";

$url .= "?id=" .urldecode($ano);

$sql = ("DELETE c, a  FROM cursando c inner join alumno a on c.id_alumno = a.id where a.id = $codigo;");
$resultado = mysqli_query($db, $sql);

if ($resultado === TRUE) {
    $_SESSION['eliminado']['exito'] = 'Estudiante eliminado con exito';
    header('location: '. $url);
} else {
    $_SESSION['eliminado']['error'] = 'error al eliminar el estudiante' ;
    header('location: '.$url);
}
//borrar usuario
}elseif(isset($_GET['codigo'])) {

    $codigo = $_GET['codigo'];

    if (isset($_SESSION['usuario_admin'] )) {
        $nombre = $_SESSION['usuario_admin']['nombre']; 
        $cargo = $_SESSION['usuario_admin']['cargo']; 
        $sql = "select * from usuarios where nombre = '$nombre' and cargo = '$cargo' and id = '$codigo'";
        $guardar = mysqli_query($db, $sql);
        if ($guardar == true && mysqli_num_rows($guardar) == 1) {
            
            $_SESSION['alerta']['usuario'] = 'No puede borrar el usuario en uso!';
            header('location: admin.php');

        }else{
            $sql = "delete from usuarios where id = $codigo";
            $guardar = mysqli_query($db, $sql);
            if ($guardar) {
                $_SESSION['guardado'] = 'Usuario eliminado con exito';
                header('location: admin.php');
            }else {
                
            }
        }

    }
    
}
?>
