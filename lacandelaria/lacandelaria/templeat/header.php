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
    <link rel="stylesheet" type="text/css" href="css/formBueno.css">
    
    <title>La Candelaria</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">  
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> 
    <link rel="stylesheet" type="text/css" href="css/tabla2.css">
    <link rel="stylesheet" type="text/css" href="css/styles3.css">
</head>
<body style="height: 500px;">
    
        <header>
            <h1>U.E.P A.P.E.P "La Candelaria"</h1>
        </header>

         <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="estudiantes.php">Estudiantes</a></li>
                <li><a href="registrar_form.php">Registrar </a></li>
                <li><a href="administrar_E.php">Administrar Alumnos</a></li>
                <li><a href="notas.php">Notas Estudiantes</a></li>

                   
                <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Añadir notas
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                                </div>
            </ul>
        </nav>



