<?php 
require_once 'helpers/funciones.php';
require_once 'model/conexion.php'; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/formulario.css">
    
    
    <title>La Candelaria</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">  
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> 
    <link rel="stylesheet" type="text/css" href="css/tabla4.css">
    <link rel="stylesheet" type="text/css" href="css/styles3.css">
    <script src="https://kit.fontawesome.com/5818af7131.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" type="text/css" href="css/boton2.css"> -->
    <!--Jquery-->
    <script language="javascript" src="jquery.js"></script>
   
    
</head>
<body >
    
        <header>
            <h1>U.E.P A.P.E.P "La Candelaria"  <?=$_SESSION['periodos']['periodo']  ?></h1>
            <?php if(isset($_SESSION['usuario_admin'])): ?>
                <p>Bienvenido <?=$_SESSION['usuario_admin']['nombre']?></p>
            <?php else: ?>
                <p>Bienvenido <?=$_SESSION['usuario_lector']['nombre']?></p>
            <?php endif; ?>
                <div class="buttons-container">
                    
                   <a class="Btn" href="logout.php">
                   <i class="fa-solid fa-right-from-bracket"></i>
                    </a>

                    
                <a href="admin.php" class="cssbuttons-io-button">
                <i class="fa-solid fa-user"></i>
                </a>
            
                </div>
                

        </header>

         <nav>
            <ul>
                <li><a class="listas" href="index.php">Inicio</a></li>
                <li><a class="listas" href="estudiantes.php">Estudiantes</a></li>
                <?php if(isset($_SESSION['usuario_admin'])): ?>
                <li><a class="listas" href="registrar_form.php">Registrar </a></li>
                <li><a class="listas" href="administrar_E.php">Administrar Alumnos</a></li>
                <?php endif; ?>
                <li><a class="listas" href="periodos.php">Periodos</a></li>
                <?php if(isset($_SESSION['usuario_admin'])): ?>
                <li><a class="listas" href="planificacion.php">Planificacion</a></li>
                <?php endif; ?>
                <li><a class="listas" href="notas.php">Registro de notas</a></li>
            
                
                
                

               



               
              
              
        </nav>



