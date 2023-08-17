<?php include_once 'templeat/header.php';
if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}
if (isset($_GET['id'])) {
    //trae las materias que trae el año
    $codigo = $_GET['id'];
    $sql = "select p.id, p.id_ano, p.id_materia, m.materia from pensum p inner join materia m on p.id_materia = m.id where p.id_ano = $codigo";
    $guardar = mysqli_query($db, $sql);
}

if (isset($_SESSION['alerta']['plan'])): ?>
    <div class="alert alert-danger" role="alert">
    <?php echo $_SESSION['alerta']['plan']; ?>
  </div>
  
<?php   endif;?>
<h2>Registro de notas</h2>
    <form method="POST" action='notas_view.php' id="register">
        <label for="first-name">Seleccionar la materia
        <select name="materia" id="" class="select">
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
            
       
       
        </label>

        <label for="age">Lapso   
            <select name="lapso" class="select">
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