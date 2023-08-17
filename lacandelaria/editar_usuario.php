<?php 
require_once 'templeat/header.php';
if (isset($_GET['usuario'])) {
    $usuario_id = $_GET['usuario'];
    $usuarios = traerUsuarios($db, $usuario_id); 
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

        
        <div class="card">
            <?php if(!empty($usuarios)):
                while($usuario = mysqli_fetch_assoc($usuarios)):
                
            ?>
                <form action="editar_view.php" method="POST" class="p-4">
                <div class="card-header">
                    Editar datos de <?=$usuario['nombre']?>
                </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre del usuario</label>
                            <input type="text" class="form-control" name="nombre" required 
                            value=" <?=$usuario['nombre'] ?>" > 
                            <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'nombre'): '';?>
                        </div>
                        <label for="">
                            Rol
                        </label>
                            <select name="id_cargo" class="select">
                                <?php 
                        $sql = "select * from cargo";
                        $guardar = mysqli_query($db, $sql);
                        while ($guardado = mysqli_fetch_assoc($guardar)):
                            ?>
                            <option value="<?=$guardado['id_rol']?>">
                                <?=$guardado['rol'] ?>
                            </option>
                            <?php endwhile; ?>
                        </select>

                        <div class="mb-3">
                            <label class="form-label">Cargo del personal</label>
                            <input type="text" class="form-control" name="cargo" required
                            value=" <?=$usuario['cargo']?>" > 
                            <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'cargo'): '';?>
                        </div>


                            
                            <input type="hidden" name="id" value="<?=$usuario['id']?>">
                            <input type="submit" class="btn btn-primary" value="Editar">
                        </div>
                </div>    
                <?php 
                endwhile;
            endif;
                ?>            
                        
                    </form>
            </div>
    </div>
</div>

<?php
borrarErrores();
require_once 'templeat/footer.php';
 ?>