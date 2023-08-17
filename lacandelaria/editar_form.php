<?php require_once 'templeat/header.php';
if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}
    if (isset($_GET['codigo'])) {
       
    $codigo= $_GET['codigo'];
    

    $sql = "SELECT a.nombre, a.apellido, a.id, a.edad, a.cedula, c.*, p.periodo, an.ano FROM cursando c inner join alumno a on c.id_alumno = a.id inner join periodo p on p.id = c.id_periodo inner join ano an on c.id_ano = an.id where a.id = $codigo";
    $editar = mysqli_query($db, $sql);
    }else{
        echo 'error';
    }


    if (isset($_SESSION['guardado']['exito'])) : ?>
        <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['guardado']['exito'] ?>
      </div>
      <?php elseif(isset($_SESSION['guardado']['error'])): ?>
          <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['guardado']['error'] ?>
      </div>
      <?php endif;?>
      
 <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

        
        <div class="card">
            <?php if (!empty($editar)):
                while($editado = mysqli_fetch_assoc($editar)):
                    $ano_limitado = $editado['ano'];
                   
                
            ?>
                <form action="editar_view.php" method="POST" class="p-4">
                <div class="card-header">
                    Editar datos de <?=$editado['nombre'].' '.$editado['apellido']?>
                </div>
                        <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="Nombre" required 
                        value=" <?=$editado['nombre'] ?>" > 
                        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'nombre'): '';?>
                        </div>
                       
                        
                        <div class="mb-3">
                        <label class="form-label">Apellido </label>
                        <input type="text" class="form-control" name="apellido"  required
                        value=" <?=$editado['apellido'];?>" > 
                        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'apellido'): '';?>
                        </div>
                        
                        <div class="mb-3">
                        <label class="form-label">Cedula</label>
                        <input type="text" class="form-control" name="cedula" required
                        value=" <?= $editado['cedula']  ?>" > 
                        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'cedula'): '';?>
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Periodo </label>
                         <?=$editado['periodo']; ?>  
                        </div>
                        <div class="mb-3">
                            <label for="ano">Año y Seccion</label>
                        <select name="ano" class="select">
                             <?php $sql = "select a.*, s.seccion from ano a left join seccion s on a.id_seccion = s.id where a.ano = '$ano_limitado' order by a.id";
                                $guardar = mysqli_query($db, $sql);
                                    while($ano = mysqli_fetch_assoc($guardar)){
                                        ?>
                                        <option value="<?=$ano['id']?>"<?=($ano['id'] == $editado['id_ano'])? 'selected' : ''; ?>>
                                        <?=$ano['ano'].' '.$ano['seccion']?> 
                                    </option>
                                        
                            <?php } ?>
                        </select>
                       
                        </div>
                        
                        <div class="mb-3">
                        <label class="form-label">Edad</label>
                        <input type="text" class="form-control" name="edad" required
                        value=" <?= $editado['edad']  ?>" > 
                        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'edad'): '';?>
                        </div>
                        </div>
                        <div class="d-grid">
                            <input type="hidden" name="codigo" value="<?=$editado['id_cu'] ?>">
                            <div>
                            </div>
                            
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
    
require 'templeat/footer.php';
borrarErrores();
?>