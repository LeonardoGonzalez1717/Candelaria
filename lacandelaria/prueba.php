<?php
session_start();
require_once 'model/conexion.php';

$sql = "select * from periodo where id = 1";
    $guardar = mysqli_query($db, $sql);
    if ($guardar == true && mysqli_num_rows($guardar) > 0) {
        $periodo = mysqli_fetch_assoc($guardar);
        
        $_SESSION['periodos'] = $periodo;
    }


    echo $_SESSION['periodos']['id'];
    var_dump($_SESSION['periodos']);