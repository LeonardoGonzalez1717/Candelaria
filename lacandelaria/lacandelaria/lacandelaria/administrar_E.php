<?php 
include_once 'templeat/header.php';
?>
<div class="container mt-2" style="height: 500px;  position: relative;">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card hola">
                <div class="card-header">
                    
                    
                 Lista de estudiantes
                 <?php 
                  if (isset($_SESSION['alertas']['periodo'])) {
                    echo $_SESSION['alertas']['periodo'];
                    
                    }elseif (isset($_SESSION['Usuario']['exito'])) {
                    
                        echo $_SESSION['Usuario']['exito'];
                    }elseif(isset($_SESSION['Usuario']['error'])) {
                    
                        echo $_SESSION['Usuario']['error'];
                    }
                    ?>
            
           
                </div>
                <div class="p-4">
                    <div class="">
                        <table class="table align-middle ">
                            <thead style="position: inherit;">
                                <tr>
                                <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'periodo'): '';?>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Cedula</th>
                                    <th scope="col">Edad</th>
                                    <th scope="col" colspan="2">Opciones</th>
                                    <th scope="col">Secciones</th>
                                    <th scope="col">Periodo</th>
                                    <th scope="col">Enviar</th>
                                    
                                </tr>
                                    
                            </thead>
                            <tbody>
                            <?php $alumnos = noconseguirEstudiantes($db); 
                                if (!empty($alumnos)):
                                    while ($alumno = mysqli_fetch_assoc($alumnos)):

                                       
                        ?>
                            <form action="administrar.php" method="POST">
                                <tr class="">
                                    <td scope="row"><?= $alumno['id'] ?></td>
                                    <td><?= $alumno['nombre']?></td>
                                    <td><?= $alumno['apellido'] ?></td>
                                    <td><?= $alumno['cedula'] ?></td>
                                    <td><?= $alumno['edad'] ?></td> 
                                    <td><a  title="Ver Notas" class="text-success" href="editar_form.php?codigo=<?=$alumno['id'] ?>"><i class="bi bi-pencil-square"></a></i></td>
                                    <td><a title="Eliminar Estudiante" onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?=$alumno['id']?>"><i class="bi bi-trash3"></i></td>
                                    <td>
                                        <select name="ano">
                                        <?php $sql = "select ano.*, s.seccion from ano left join seccion s on ano.id_seccion = s.id order by ano.id";
                                                $guardar = mysqli_query($db, $sql);
                                                while($ano = mysqli_fetch_assoc($guardar)){
                                                    ?>
                                            <option value="<?=$ano['id']?>"><?=$ano['ano']. ' ' .$ano['seccion'] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><input type="text" placeholder="Periodo" name="periodo"></td>
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