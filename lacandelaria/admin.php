<?php 
require_once 'templeat/header.php';
if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}
 if(isset($_SESSION['guardado'])): ?>
  <div class="alert alert-success" role="alert">
  <?php echo $_SESSION['guardado']?>
</div>
<?php elseif(isset($_SESSION['alerta']['usuario'])): ?>
    <div class="alert alert-warning" role="alert">
  <?php echo $_SESSION['alerta']['usuario']?>
</div>
<?php endif; ?>
<div class="container mt-2" style="height: 500px;  position: relative;">
<div class="ayuda">

    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card hola">
                <h2>Usuarios del sistema</h2>
                        <table class="table align-middle ">
                            <thead>
                                <tr>
                                        
                                
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cargo</th>
                                    <th scope="col">Rol</th>
                                    <?php if(isset($_SESSION['usuario_admin'])): ?>
                                    
                                    <th scope="col" colspan="2">Opciones</th>
                                    <?php endif; ?>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                        
                                <?php      
                                            $usuarios = traerUsuarios($db, null);
                                            while($usuario = mysqli_fetch_assoc($usuarios)):     
                                ?>
                                <tr class="">
                                    <td><?= $usuario['nombre']?></td>
                                    <td><?= $usuario['cargo'] ?></td>
                                    <td><?= $usuario['rol'] ?></td>
                                    <?php if(isset($_SESSION['usuario_admin'])): ?>
                                    
                                    <td><a  title="Editar" class="text-success" href="editar_usuario.php?usuario=<?=$usuario['id']?>"><i class="bi bi-pencil-square"></a></i>
                                    <a title="Eliminar usuario" onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?=$usuario['id']?>"><i class="bi bi-trash3"></i>
                                    </td> 
                                    <?php endif; ?>
                                </tr>
                            
                                <?php
                            endwhile;
                             ?>     
                            </tbody>
                        </table>
                        <?php if(isset($_SESSION['usuario_admin'])): ?>
                <a href="usuario_nuevo.php" class="cssbuttons-io-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg>
                <span>Crear Usuario</span>
                </a>
                <?php endif; ?>
            
            
                 
             </div>
        
            </div>
        </div>
    </div>  
</div>


<?php 
borrarErrores();
require_once 'templeat/footer.php';
?>