<?php 
session_start();
require_once 'model/conexion.php';
if (isset($_POST['periodo_nuevo'])){
    $alertas = array();
    
    if (!empty($_POST['periodo_nuevo'])){
        if (!preg_match("/[a-zA-Z]/", $_POST['periodo_nuevo'])) {
            $periodo = mysqli_escape_string($db, $_POST['periodo_nuevo']);
            
        }else{
            $alertas['periodo'] = 'Periodo invalido';  
        }    
            if (count($alertas) == 0){
                $sql = "insert into periodo values(null, '$periodo')";
                $periodo = mysqli_query($db, $sql);
                if ($periodo == true) {
                    $_SESSION['guardado'] = 'Periodo registrado con exito';
                    header('location: periodos.php');
                    
                }else{
                    $_SESSION['alerta'] = 'Periodo ya existe';
                    header('location: periodos.php');
                }
            
            }else{
                $_SESSION['alertas'] = $alertas;
                header('location: periodos.php');
            }   
            
        }else{
            $_SESSION['alerta'] = 'Periodo no puede estar vacio';
            header('location: periodos.php');
    }

}elseif(isset($_POST['periodo'])){
    //periodo

    $periodo_id = $_POST['periodo'];

    $sql = "select * from periodo where id = $periodo_id";
    $guardar = mysqli_query($db, $sql);
    if ($guardar == true && mysqli_num_rows($guardar) > 0) {
        $periodo = mysqli_fetch_assoc($guardar);

        $_SESSION['periodos'] = $periodo;
        header('location: index.php');
    }
       //planificacion
}elseif(!empty($_POST['lapso']) && !empty('evaluaciones')) {
    $alertas = array();
    $periodo = $_SESSION['periodos']['periodo'];
   
    if (isset($_POST['materia']) && isset($_POST['lapso']) && isset($_POST['evaluaciones']) && isset($_POST['ano'])) {
        
        $id_ano = $_POST['ano'];
        $id_materia = $_POST['materia'];
        $url = "planificacion.php";
        $url .= "?id=" . urldecode($id_ano);


        if (is_numeric($_POST['lapso']) && !preg_match("/[a-zA-Z]/", $_POST['lapso']) ) {
            $lapso = $_POST['lapso'];
            $lapso_escapado = mysqli_escape_string($db, $lapso);
            
        }else{
            $alertas['lapso'] = 'Lapso Invalido';
        }
        if (is_numeric($_POST['evaluaciones']) && !preg_match("/[a-zA-Z]/", $_POST['evaluaciones'])) {
            $evaluacion = $_POST['evaluaciones'];
            $evaluaciones = mysqli_escape_string($db, $evaluacion); 

            
        }else{
            $alertas['evaluacion'] = 'Evaluacion invalida';
        }


        if (count($alertas) == 0){
            var_dump($id_ano);
            $sql = "insert into planificacion values(null, '$id_materia', '$id_ano', '$evaluaciones', '$lapso_escapado', '$periodo')";
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




?>