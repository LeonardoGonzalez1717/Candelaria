<?php 
require_once 'model/conexion.php';
session_start();
$materia = $_POST['materia'];
$ano = $_POST['ano'];

$url = "notas_view.php";
$url .= "?materia=" .urlencode($materia);
$url .= "&ano=" .urlencode($ano);

if (!empty($_POST['nota']) && !empty($_POST['lapso']) ) {
        //convirtiendo string en enteros
        $nota = (int)$_POST['nota'];
        $lapso = (int)$_POST['lapso'];

   
    if (is_integer($nota) && preg_match('/^[0-9]+$/',$nota) ) {
        $nota_validada = $nota;
        
    }else{
        $_SESSION['guardado']['error'] = 'La nota solamente debe contener numeros ';
    } 
    if (is_integer($lapso) && preg_match('/^[0-9]+$/',$lapso) ) {
        $lapso_validada = $lapso;
        
    }else{
        $_SESSION['guardado']['error'] = 'el lapso solamente debe contener numeros ';
    } 
    if (isset($_POST['pensum']) && !empty($_POST['pensum']) ) {
        $pensum = $_POST['pensum'];
    }else{
        echo 'error3';
    }
    
    if (isset($_POST['alumno']) && !empty($_POST['alumno'])) {
        $alumno =$_POST['alumno']; 
    }else{
        echo 'error4';
    }
    $sql = "insert into notas values(null, '$alumno', '$pensum', '$nota_validada', '$lapso_validada')";
    $guardar = mysqli_query($db, $sql);

    if ($guardar == true) {
        $_SESSION['guardado']['exito'] = 'Nota registrada';
        header("Location: " . $url);
        exit();
    }else{
        $_SESSION['guardado']['error'] = 'fallo al registrar nota';
        header("Location: " . $url);
        exit();
    }
    
}else{
    $_SESSION['guardado']['error'] = 'La nota no puede estar vacio';
    header('location: ' . $url);
    exit();
}

?>


