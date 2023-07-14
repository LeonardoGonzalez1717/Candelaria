<?php
require_once 'templeat/header.php';
?>



    <h2>Registro de estudiantes</h2>
    <form method="POST" action='register_view.php' id="register">
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'nombre'): '';?>
        <label for="first-name">Nombre: <input id="first-name" name="nombre" type="text" required /></label>

        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'apellido'): '';?>
        <label for="last-name">Apellido <input id="last-name" name="apellido" type="text" required /></label>

        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'cedula'): '';?>
        <label for="age">Cedula <input id="cedula" type="number" name="cedula"/></label>
        
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'edad'): '';?>
        <label for="age">Edad <input id="age" type="number" name="edad" min="12" max="120" /></label>
            <input type="submit" value="Registrar" />
            <?php 
            if (isset($_SESSION['alerta'])) {
                echo $_SESSION['alerta'];
            }
            ?>
    </form>


<?php
  include_once 'templeat/footer.php';
  ?>
  <?php borrarErrores(); ?>
    