<?php 
require_once 'model/conexion.php';
session_start();
if (!empty($_POST['lapso']) && !empty('evaluaciones')) {
    $alertas = array();
   
    if (isset($_POST['materia']) && isset($_POST['lapso']) && isset($_POST['evaluaciones']) && isset($_POST['ano'])) {
        $id_ano = $_POST['ano'];
        $id_materia = $_POST['materia'];


        $url = "planificacion.php";
        $url .= "?id=" . urldecode($id_ano);


        if (is_numeric($_POST['lapso']) && !preg_match("/[a-zA-Z]/", $_POST['lapso']) ) {
            $lapso = mysqli_escape_string($db, $_POST['lapso']);
            
        }else{
            $alertas['lapso'] = 'error en el lapso';
        }
        if (is_numeric($_POST['evaluaciones']) && !preg_match("/[a-zA-Z]/", $_POST['evaluaciones'])) {
            $evaluaciones = mysqli_escape_string($db, $_POST['evaluaciones']);   
            
        }else{
            $alertas['evaluacion'] = 'error en la evaluacion';
        }


        if (count($alertas) == 0){
            $sql = "insert into planificacion values(null, '$id_materia', '$id_ano', '$evaluaciones', '$lapso')";
            $guardar = mysqli_query($db, $sql);
            if ($guardar) {
                $_SESSION['guardado'] = 'Guardado exitosamente';
                header('Location:' . $url);
                
            }else{
                echo 'error4'; 
            }
        }else{
            $_SESSION['alertas'] = $alertas;
            header('Location:' . $url);
            
           
        }
    }else{
        echo 'error1';
    }
}else{
    echo 'error2';
}