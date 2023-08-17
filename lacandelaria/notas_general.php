<?php 
require_once 'templeat//header.php';
if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}
if (isset($_GET['alumno'])) {

    $id_alumno = $_GET['alumno'];
    
    

    $sql = "select n.*, a.nombre, a.apellido from notas n inner join alumno a on a.id = n.id_alumno inner join pensum p on p.id = n.id_pensum inner join materia m on m.id = p.id_materia where id_alumno = $id_alumno";
    $guardar = mysqli_query($db, $sql);
    
    $guardado = mysqli_fetch_assoc($guardar);
  

      
}else{
    echo 'no existe';
}
?>
<div class="container mt-2" style="height: 500px;  position: relative;">
<div class="ayuda">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card hola">
                <div class="card-header" style="position: sticky; top: 0; background-color: white;">
                <?php if(!empty($guardado)): ?>
                    Listado de notas de <?=$guardado['nombre'].' '.$guardado['apellido']?> 
                <?php else: ?>
                    No hay notas para mostrar
                    <?php endif; ?>
                                    
                </div>
                <div class="">
                    <div class="">
                        <table class="table align-middle ">
                            <thead>
                                <tr>
                                    
                                    <th scope="col">Materia</th>
                                    
                                    <th scope="col">Promedio</th>
                                    <th scope="col">Notas detalladas</th>
                                   
                                    
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $sql = "SELECT n.id_pensum, m.materia, n.lapso FROM notas n INNER JOIN pensum p ON n.id_pensum = p.id INNER JOIN materia m on m.id = p.id_materia  WHERE n.id_alumno = $id_alumno GROUP BY n.id_pensum ORDER BY n.lapso ASC;"; 
                                    $guardar = mysqli_query($db, $sql);
                                    while($guardado = mysqli_fetch_assoc($guardar)){
                                          $promedios_total = array();
                                         
                                          $id_pensum = $guardado['id_pensum'];
                                    
                                       
                                    ?>
                                    <tr class="">
                                        <td><?= $guardado['materia']?></td>
                                        
                                        <?php
                                            $sql = "SELECT AVG(nota) AS promedio FROM notas  where id_alumno = $id_alumno and id_pensum = $id_pensum GROUP BY id_pensum, lapso;"; 
                                            $promedios = mysqli_query($db, $sql);
                                            if (!empty($promedios)) {
                                            while($promedio = mysqli_fetch_assoc($promedios)){
                                                $promedios_total[] = $promedio['promedio'];
                                                $promedios_final = array_sum($promedios_total)/count($promedios_total);
                                            } 
                                        }
                                        $promedios_final = number_format($promedios_final, 2)
                                        ?>
                                        <td><?= $promedios_final?></td>
                                        <td><a title="Notas detalladas" class="text-success" href="notas_estudiantes.php?alumno=<?=$id_alumno?>&pensum=<?=$guardado['id_pensum'] ?>"><i class="bi bi-archive-fill"></i></a></td>
                                    </tr>
                             <?php } ?>
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
require_once 'templeat/footer.php'; 
?>