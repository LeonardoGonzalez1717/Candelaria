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

}elseif(isset($_GET['periodo'])){
    //periodo

    $periodo_id = $_GET['periodo'];

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
        var_dump($id_materia);
        


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
            $alertas['evaluacion'] = 'Cantidad invalida';
        }
        
        
        
        if(count($alertas) == 0){
            $sqlE = "select * from planificacion where id_materia = '$id_materia' and id_ano = '$id_ano' and lapso = '$lapso' and periodo = '$periodo'";
            $guardarE = mysqli_query($db, $sqlE); 
            if ($guardarE == true && mysqli_num_rows($guardarE) == 1) {
                $_SESSION['alerta'] = 'La planificacion de esta materia ya existe';
                header('location: planificacion.php');
            }else{

                $sql = "insert into planificacion values(null, '$id_materia', '$id_ano', '$evaluaciones', '$lapso_escapado', '$periodo')";
                $guardar = mysqli_query($db, $sql);
                if ($guardar) {
                    $_SESSION['guardado'] = 'Guardado exitosamente';
                    header('Location: planificacion.php');
                    
                }else{
                    echo 'error4';
                }
            }
        }else{
            $_SESSION['alertas'] = $alertas;
            header('Location: planificacion.php');
            
           
        }
    }else{
        echo 'error1';
    }
}else{
    echo 'error2';
}




?>