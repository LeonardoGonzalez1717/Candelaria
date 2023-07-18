<?php 
include_once 'templeat/header.php';
if (isset($_GET['id'])) {
    
    $codigo = $_GET['id'];
}
$sql = "select p.id, p.id_ano, p.id_materia, m.materia from pensum p inner join materia m on p.id_materia = m.id where p.id_ano = $codigo";
$guardar = mysqli_query($db, $sql);

?>

<h2>Registro de estudiantes</h2>
    <form method="POST" action='notas_view.php' id="register">
        <label for="first-name">Seleccionar la materia
        <select name="materia" id="">
                                        <?php 
                                        if(!empty($guardar)):
                                            while ($guardado = mysqli_fetch_assoc($guardar)):
                                        ?>
                                            <option value="<?=$guardado['id_materia']?>"><?=$guardado['materia']?></option>`
                                            
                                            <?php 
                                        endwhile;
                                    endif;
                                    ?>
                                        </select>
        </label>

        <label for="last-name">Cantidad de evaluaciones <input type="number" value="2" name="filas" min = "2" max="4" required/>
       
        </label>

        <label for="age">Lapso   
            <select name="lapso" >
                <option value="1">Lapso 1 </option>
                <option value="2">Lapso 2 </option>
                <option value="3">Lapso 3 </option>
            </select>
        
        </label>
        
                                    <input type="hidden" name="ano" value="<?=$codigo?>">
            <input type="submit" value="Registrar" id="submitForm" />
           
    </form> 
                    
               
                               

<?php
include_once 'templeat/footer.php'; 
borrarErrores();

?>