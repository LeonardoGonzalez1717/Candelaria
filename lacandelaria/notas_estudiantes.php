<?php 
require_once 'templeat//header.php';
if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}
if (isset($_GET['alumno']) && isset($_GET['pensum'])) {

    $id_alumno = $_GET['alumno'];
    $pensum = $_GET['pensum'];
    
    

    $sql = "select n.*, a.nombre, a.apellido, m.materia from notas n inner join alumno a on a.id = n.id_alumno inner join pensum p on p.id = n.id_pensum inner join materia m on m.id = p.id_materia where id_alumno = $id_alumno and n.id_pensum = $pensum";
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
                    Listado de notas de <?=$guardado['nombre'].' '.$guardado['apellido'].'/'. $guardado['materia']?> 
                <?php else: ?>
                    No hay notas para mostrar
                    <?php endif; ?>
                                    
                </div>
                <div class="">
                    <div class="">
                        <table class="table align-middle ">
                            <thead>
                                <tr>
                                    <th scope="col"> Notas</th>
                                     
                                    <th scope="col">Nota final</th>
                                    <th scope="col">Lapso</th>
                                   
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php           
                                    
                                    $alumnos = ConseguirNotas($db, $id_alumno, $pensum);
                                    if (!empty($alumnos)):
                                    while($alumno = mysqli_fetch_assoc($alumnos)):
                                        $lapso = $alumno['lapso'];
                                        $promedio = number_format($alumno['promedio'], 2);
                                    ?>
                                
                                    <tr class="">
                                        
                                        <?php 
                                        $sql = "select nota from notas where id_alumno = $id_alumno and id_pensum = $pensum and lapso = $lapso ";
                                        $notas = mysqli_query($db, $sql);
                                        if (!empty($notas)) {
                                            
                                            $notas_count = mysqli_num_rows($notas);
                                            $i = 0;
                                            echo '<td class="flex">';
                                            while($guardado = mysqli_fetch_assoc($notas)){
                                            $i++;
                                            echo '<span>'.$guardado['nota'].'</span>';
                                        }
                                        echo '</td>';
                                        }else{
                                            echo 'no hay notas registradas';
                                        }

                                        ?>
                                    <td><?= $promedio?></td>
                                    <td><?= $alumno['lapso'] ?></td> 
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
require_once 'templeat/footer.php'; 
?>