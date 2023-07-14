<?php 
require_once 'templeat/header.php';

if (isset($_POST['materia']) && isset($_POST['ano'])  && isset($_POST['filas']) && !empty($_POST['filas']) && isset($_POST['lapso'])) {
    $ano = $_POST['ano'];
    $materia = $_POST['materia'];  
    $lapso = $_POST['lapso'];
    $f = $_POST['filas'];
    
}elseif(isset($_GET['materia']) && isset($_GET['ano'])){
    $ano = $_GET['ano'];
    $materia = $_GET['materia']; 
}else{
    echo 'los campos no deben estar vacios';
}
 if (isset($materia) && $ano) {
     $sql = "select p.id_ano, p.id_materia,p.id, m.materia, a.ano, s.seccion from pensum p inner join materia m on p.id_materia = m.id inner join ano a on p.id_ano = a.id inner join seccion s on a.id_seccion = s.id where p.id_materia = $materia and p.id_ano = $ano";
     $guardar = mysqli_query($db, $sql);
    
 }

?>
<?php if(isset($_SESSION['guardado']['exito'])):?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['guardado']['exito']?>
      </div>
<?php elseif(isset($_SESSION['guardado']['error'])): ?> 
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['guardado']['error'] ?>
      </div>
<?php endif; ?>

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
                                                                    
                                            <div> <h4>Registro de notas de estudiantes de: <?=$guardado['materia']?> / <?=$guardado['ano'].' / '.$guardado['seccion'] ?></h4></div>
                                        <?php endif; ?>                             
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
                                        <?php for($i=1; $i<=$f; $i++){
                                               echo '<th>Nota'. $i .'</th>'; 
                                             } ?>
                                    <th scope="col" class="lapso">Lapso</th>
                                   
                                    <th scope="col">ENVIAR</th>
                            
                                    
                                </tr>
                            </thead>
                            <tbody>
                        
                                <?php
                                    if (isset($ano)){
                                        
                                        $alumnos = ConseguirTodosEstudiantes($db, $ano);   

                                    }else{
                                        echo 'error1'; 
                                    }
                                            if (!empty($alumnos)):
                                            while($alumno = mysqli_fetch_assoc($alumnos)):  
                                                
                                                
                                            ?>
                                                
                                                
                                                
                                    <tr class="aaa">
                                    <form action="notas_form.php" method="POST" > 
                                       

                                        <td><?= $alumno['id_alumno']?></td>
                                        <td><?= $alumno['nombre']?></td>
                                        <td><?= $alumno['apellido'] ?></td>
                                        <td><?= $alumno['cedula'] ?></td>
                                                
                                                <?php
                                            if(existeNota($db, $alumno['id_alumno'], $guardado['id'])){
                                                $notas_total = "select notas.id, notas.nota, notas.lapso, pensum.id_materia from notas inner join pensum on notas.id_pensum = pensum.id where notas.id_alumno = ".$alumno['id_alumno']." and pensum.id_materia = $materia";
                                                $notas = mysqli_query($db, $notas_total);
                                                 
                                                while($nota = mysqli_fetch_assoc($notas)){

                                                    
                                                       

                                                        for($i=$f-1; $i<=$f; $i++){
                                                            $n = $f-$i;
                                                            for($o=1; $o<=$n; $o++){
                                                                echo '<td><input type="number" maxlength="5" name="evaluacion" value="'.$nota['nota'].'"></td>';  
                                                            }
                                                        }
                                                        
                                                        
                                                    }
                                                    
                                                }else{
                                                    
                                                    for($i = 1; $i <= $f; $i++){
                                                        echo '<td><input type="number" maxlength="5" name="evaluacion" min="0" max="20"></td>';  
                                                    }
                                                    
                                                }
                                            
                                             ?>
                                                
                                                <td><input type="number" name="lapso" value="<?=$lapso?>"></td>   
                                                <td><input type="submit" value="Enviar Notas"></td>
                                                <input type="hidden" name="alumno" value="<?= $alumno['id_alumno']?>">
                                                <input type="hidden" name="pensum" value="<?=$guardado['id']?>">
                                                <input type="hidden" name = "materia" value="<?=$materia?>">
                                                <input type="hidden" name="ano" value="<?=$ano?>">
                                        
                                        </form>
                                        <?php
                                            endwhile;
                                        endif;
                                        ?>     
                                    
                                        
                                    </tr>
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
include_once 'templeat/footer.php'; 
borrarErrores();

?>