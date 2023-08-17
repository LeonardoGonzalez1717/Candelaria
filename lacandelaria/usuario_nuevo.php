<?php 
require_once 'templeat/header.php';
if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}
 if(isset($_SESSION['alerta'])): ?>
  <div class="alert alert-success" role="alert">
  <?php echo $_SESSION['alerta']?>
</div>
<?php endif; ?>


<h2>Crear nuevo usuario</h2>
    <form method="POST" action='register_view.php' id="register">
        <label for="first-name">Nombre: <input id="first-name" name="nombre_usuario" type="text" required />
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'nombre'): '';?>
        </label>

        <label for="last-name">Cargo<input id="first-name" name="cargo" type="text" required/>
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'cargo'): '';?>
    </label>

        <label for="rol">Rol
        <select name="rol" class="select">
            <?php  
            $sql = "select * from cargo";
            $cargo = mysqli_query($db, $sql);
            if(!empty($cargo)):
            while($cargos = mysqli_fetch_assoc($cargo)):
            ?>
            
            <option  value="<?=$cargos['id_rol'] ?>">
                <?= $cargos['rol'] ?>
            </option>
            <?php endwhile;
            endif; ?>

        </select>
        </label>
        
        <label for="age">Contraseña<input id="age" type="text" name="password"/>
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'password'): '';?>
        </label>
            <label for="send"><input type="submit" value="Añadir" id="submitForm" /></label> 
    </form>

<?php 
borrarErrores();
require_once 'templeat/footer.php';
?>