<?php 
include_once 'templeat/header.php';
if (isset($_GET['id'])) {
    
    $codigo = $_GET['id'];
}
$sql = "select p.id, p.id_ano, p.id_materia, m.materia from pensum p inner join materia m on p.id_materia = m.id where p.id_ano = $codigo";
$guardar = mysqli_query($db, $sql);

?>
<div class="container mt-2" style="height: 500px;  position: relative;">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card hola">
                <div class="card-header">
                    
                    
                Registro de notas

                </div>
                <div class="p-4">
                    <div class="">
                        <table class="table align-middle ">
                            <thead style="position: inherit;">
                               Que materia desea registrar notas?     
                            </thead>
                            <tbody>
                                
                            <form action="notas_view.php" method="POST">
                                <tr class="">
                                    <td>

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
                                    </td>
                                    <td> 
                                        <input type="number" name="filas" min = "1" max="4" required>
                                    </td>
                                    <td> 
                                        <select name="lapso" >
                                            <option value="1">Lapso 1 </option>
                                            <option value="2">Lapso 2 </option>
                                            <option value="3">Lapso 3 </option>
                                        </select>
                                    </td>
                                    <input type="hidden" name="ano" value="<?=$codigo?>">
                                    <td><input type="submit"></td>
                                </tr>
                            </form>
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