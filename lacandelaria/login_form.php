<?php session_start();
require_once 'helpers/funciones.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> 
    

    <link rel="stylesheet" href="css/login.css">
    <title>Inicio de sesion La Candelaria</title>
</head>
<body>

    
    <div class="form_container">
       <?php if (isset($_SESSION['alerta'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['alerta']?>
        </div>
      <?php endif; ?>
   <form action="login_view.php" method="post">
    <h1>INICIO DE SESION</h1>
            <div class="group">
            <input  type="text" class="input" name="nombre">
            <span class="highlight"></span>
            <span class="bar">

                <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'nombre'): '';?>
            </span>
            <label>Nombre</label>
            </div>
                <div class="group">
                <input  type="text" class="input" name="cargo">
                <span class="highlight"></span>
                <span class="bar"></span>
                <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'cargo'): '';?>
                <label>Cargo del usuario</label>
            </div>
            <div class="group">
            <input  type="text" class="input" name="password">
            <span class="highlight"></span>
            <span class="bar"></span>
            <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'password'): '';?>
            <label>Contraseña</label>
            </div>
        <input type="submit" value="Iniciar Sesion">
    </form>
   </div>
</body>
</html>
<?php borrarErrores(); ?>