<?php require_once 'templeat/header.php' ?>

<?php 
    if (isset($_GET['codigo'])) {
       
    $codigo= $_GET['codigo'];

    $sql = "SELECT a.nombre, a.apellido, a.id, a.edad, a.cedula, c.* FROM cursando c inner join alumno a on c.id_alumno = a.id where a.id = $codigo";
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
                
            ?>
                <form action="editar_view.php" method="POST" class="p-4">
                <div class="card-header">
                    Editar datos de <?=$editado['nombre'].' '.$editado['apellido']?>
                </div>
                        <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="Nombre" required 
                        value=" <?=$editado['nombre'] ?>" > 
                        </div>
                       
                        
                        <div class="mb-3">
                        <label class="form-label">Apellido </label>
                        <input type="text" class="form-control" name="apellido"  required
                        value=" <?=$editado['apellido'] ; ?>" > 
                        </div>
                        
                        <div class="mb-3">
                        <label class="form-label">Cedula</label>
                        <input type="text" class="form-control" name="cedula" required
                        value=" <?= $editado['cedula']  ?>" > 
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Periodo </label>
                        <input type="text" class="form-control" name="periodo"  required
                        value=" <?=$editado['periodo'] ; ?>" > 
                        </div>
                        <div class="mb-3">
                        <select name="ano">
                             <?php $sql = "select ano.*, s.seccion from ano left join seccion s on ano.id_seccion = s.id order by ano.id";
                                $guardar = mysqli_query($db, $sql);
                                    while($ano = mysqli_fetch_assoc($guardar)){
                                        ?>
                                        <option value="<?=$ano['id']?>"><?=$ano['ano'].' '. $ano['seccion'] ?> </option>
                                        
                            <?php } ?>
                        </select>
                       
                        </div>
                        
                        <div class="mb-3">
                        <label class="form-label">Edad</label>
                        <input type="text" class="form-control" name="edad" required
                        value=" <?= $editado['edad']  ?>" > 
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