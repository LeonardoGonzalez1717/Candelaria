<?php
require_once 'templeat/header.php';
if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}
?>
    <h2>Registro de estudiantes</h2>
    <form method="POST" action='register_view.php' id="register">
        <label for="first-name">Nombre: <input id="first-name" name="nombre" type="text" required />
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'nombre'): '';?>
        </label>

        <label for="last-name">Apellido <input id="last-name" name="apellido" type="text" required />
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'apellido'): '';?>
        </label>

        <label for="cedula">Cedula <input id="cedula" type="number" name="cedula"/>
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'cedula'): '';?>
        </label>
        
        <label for="age">Edad <input id="age" type="number" name="edad" min="12" max="120" />
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'edad'): '';?>
        </label>
            <label for="send"><input type="submit" value="Registrar" id="submitForm" />
            <?php 
            if (isset($_SESSION['alerta'])) {
                echo $_SESSION['alerta'];
            }
            ?>
            </label> 
    </form>


<?php
  include_once 'templeat/footer.php';
  ?>
  <?php borrarErrores(); ?>
    