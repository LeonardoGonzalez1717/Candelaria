<?php
require_once 'templeat/header.php';

if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}
if (isset($_GET['id'])) {
    $codigo = $_GET['id'];
     $sql = "select * from ano a inner join seccion s on a.id_seccion = s.id where a.id = $codigo;";
      $guardar = mysqli_query($db, $sql); 
}

if (isset($_SESSION['eliminado']['exito'])) : ?>
  <div class="alert alert-success" role="alert">
  <?php echo $_SESSION['eliminado']['exito'] ?>
</div>
<?php elseif(isset($_SESSION['eliminado']['error'])): ?>
    <div class="alert alert-warning" role="alert">
  <?php echo $_SESSION['eliminado']['error'] ?>
</div>
<?php endif;?>


<?php if (isset($_SESSION['guardado']['exito'])) : ?>
        <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['guardado']['exito'] ?>
      </div>
      <?php elseif(isset($_SESSION['guardado']['error'])): ?>
          <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['guardado']['error'] ?>
      </div>
      <?php endif;?>

    <form  action="buscar.php" method="post" class="d-flex" role="search">
      <input class="form-control me-2" type="buscar" aria-label="Search"  name="buscador">
      <button class="btn btn-success bi bi-search" type="submit"></button>
  </form>
<main>
    
<div class="container mt-2" style="height: 500px;  position: relative;">
<div class="ayuda">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card hola">
                <div class="card-header" style="position: sticky; top: 0; background-color: white;">
                    
            
           
                                    <?php 
                                    if(!empty($guardar) && isset($guardar)) 
                                            $guardado = mysqli_fetch_assoc($guardar);
                                                if (!empty($guardado)): ?>
                                                                    
                                            <div> <h2>Lista de estudiantes de</h2><?=$guardado['ano'].'|| Seccion '.$guardado['seccion'] ?></div>
                                        <?php else: ?>    
                                            <div> <h2> Listado de todos los estudiantes</h2></div>
                                        <?php endif; 
                                        ?>
                </div>
                <div class="">
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
                                 $periodo = $_SESSION['periodos']['id'];
                               
                                    if (isset($codigo)){
                                                                
                                            $alumnos = ConseguirTodosEstudiantes($db, $codigo, $periodo);

                                                }elseif(!isset($codigo)){ 
                                            $alumnos = ConseguirTodosEstudiantes($db, null, $periodo);
                                                        
                                                }
                                            if (!empty($alumnos)):
                                        while($alumno = mysqli_fetch_assoc($alumnos)):    
                                ?>
                                <tr class="">
                                    <td scope="row"><?= $alumno['id_cu'] ?></td>
                                    <td><?= $alumno['nombre']?></td>
                                    <td><?= $alumno['apellido'] ?></td>
                                    <td><?= $alumno['cedula'] ?></td>
                                    <td><?= $alumno['ano']?></td> 
                                    <td><?= $alumno['seccion'] ?></td> 
                                    <td><?= $alumno['periodo'] ?></td> 
                                    <td><a  title="Editar" class="text-success" href="editar_form.php?codigo=<?=$alumno['id_alumno']?>"><i class="bi bi-pencil-square"></a></i>
                                    <a title="Eliminar Estudiante" onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?=$alumno['id_alumno']?>&ano=<?=$codigo?>"><i class="bi bi-trash3"></i>
                                    <a title="Ver Nota" class="text-success" href="notas_general.php?alumno=<?=$alumno['id_alumno']?>&ano=<?=$alumno['id_ano'] ?>"><i class="bi bi-archive-fill"></i></a>
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
</main>

<?php
include_once 'templeat/footer.php'; 
borrarErrores();

?>
