<?php 
require_once 'templeat/header.php';
if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}
if (empty($_POST['buscador'])) {
    echo 'la busqueda no puede estar vacia';
}else{
    $periodo = $_SESSION['periodos']['id'];
    $buscador = buscador($db, $_POST['buscador'], $periodo);
}
?>
  <form  action="buscar.php" method="post" class="d-flex" role="search">
      <input class="form-control me-2" type="text" aria-label="Search"  name="buscador">
      <button class="btn btn-success bi bi-search" type="submit"></button>
  </form>
    
  <?php 
  if (isset($_SESSION['busqueda']['error'])) : ?>
  <div class="alert alert-danger" role="alert">
    <?=$_SESSION['busqueda']['error'] ?>
</div>
<?php endif;?>


<div class="container mt-2" style="height: 500px;">
<div class="ayuda">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card hola">
                <div class="card-header" style="position: sticky; top: 0; background-color: white;">
                    <h2>Busqueda de: <?=$_POST['buscador']?> </h2>              
                </div>
                <div class="p-3">
                    <div class="">
                        <table class="table align-middle ">
                            <thead>
                                <tr>
                                        
                                
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Cedula</th>
                                    <th scope="col">Año</th>
                                    <th scope="col">Seccion</th>
                                    <th scope="col">Periodo</th>
                                    <th scope="col" colspan="3">Opciones</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   
                                   if(!empty($buscador)):
                                    while($busqueda = mysqli_fetch_assoc($buscador)):
                                ?>
                        
                                <tr class="">
                                    <td scope="row"><?= $busqueda['id_cu'] ?></td>
                                    <td><?= $busqueda['nombre']?></td>
                                    <td><?= $busqueda['apellido'] ?></td>
                                    <td><?= $busqueda['cedula'] ?></td>
                                    <td><?= $busqueda['ano']?></td> 
                                    <td><?= $busqueda['seccion'] ?></td> 
                                    <td><?= $busqueda['periodo'] ?></td> 
                                    <td><a  title="Editar" class="text-success" href="editar_form.php?codigo=<?=$busqueda['id_alumno']?> "><i class="bi bi-pencil-square"></a></i>
                                    <a title="Eliminar Estudiante" onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?=$busqueda['id_alumno']?>&ano=<?=$codigo?>"><i class="bi bi-trash3"></i>
                                    <a title="Ver Nota" class="text-success" href="notas_general.php?alumno=<?=$busqueda['id_alumno']?>&ano=<?=$busqueda['id_ano'] ?>"><i class="bi bi-archive-fill"></i></a>
                                    </td> 
                                </tr>
                            
                                <?php
                                endwhile;
                            endif;
                             ?>     
                            </tbody>
                        </table>
                    </div>
            
                 </div>
             </div>
        
            </div>
        </div>
    </div>  
</div>
<?php 
borrarErrores();
require_once 'templeat/footer.php';
?>