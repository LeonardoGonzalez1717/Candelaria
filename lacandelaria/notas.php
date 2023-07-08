<?php 
include_once 'templeat/header.php';
?>
<div class="container mt-2" style="height: 500px;  position: relative;">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card hola">
                <div class="card-header">
                    
                    
                 Lista de estudiantes

                </div>
                <div class="p-4">
                    <div class="">
                        <table class="table align-middle ">
                            <thead style="position: inherit;">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Cedula</th>
                                    <th scope="col" colspan="3">Notas</th>
                                    <th scope="col">Enviar</th>
                                    
                                </tr>
                                    
                            </thead>
                            <tbody>
                            <?php $alumnos = conseguirAlumno($db); 
                                if (!empty($alumnos)):
                                    while ($alumno = mysqli_fetch_assoc($alumnos)):

                                       
                        ?>
                            <form action="administrar.php" method="POST">
                                <tr class="">
                                    <td scope="row"><?= $alumno['id'] ?></td>
                                    <td><?= $alumno['nombre']?></td>
                                    <td><?= $alumno['apellido'] ?></td>
                                    <td><?= $alumno['cedula'] ?></td>
                                    <?php $nota = Nonotas($db); 
                                
                                    while ($notas = mysqli_fetch_assoc($nota)){
                                    ?>
                                    <td><input name="nota" value="<?=$notas['nota']?>"> </input></td>
                                    <?php  } ?>
                                    <input type="hidden" name="estudiante" value="<?=$alumno['id']?>">
                                    <td><input type="submit"></td>
                                </tr>
                            </form>
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

<?php
include_once 'templeat/footer.php'; 
borrarErrores();

?>