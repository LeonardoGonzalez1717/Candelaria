<?php 
require_once 'templeat/header.php'; 

if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}
?>
<?php if (isset($_SESSION['guardado'])) : ?>
        <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['guardado'] ?>
      </div>
      <?php elseif(isset($_SESSION['alerta'])): ?>
        <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['alerta'] ?>
      </div>
      <?php endif; ?>

    <h2>Periodo que a registrar</h2>
    <form method="POST" action='periodos_view.php' id="register">
        <label for="first-name">Periodo que desea registrar<input id="first-name" name="periodo_nuevo" type="text" required />
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'periodo'): '';?>
        </label>
        <input type="submit"  value="Enviar">
    </form>
  
<?php 
borrarErrores();
require_once 'templeat/footer.php';
?>