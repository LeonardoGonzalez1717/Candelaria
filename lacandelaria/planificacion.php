<?php 
require_once 'templeat/header.php';
if (isset($_GET['id'])) {
    $ano = $_GET['id'];
}
?>
<?php if (isset($_SESSION['guardado'])) : ?>
        <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['guardado'] ?>
      </div>
      <?php endif; ?>


<h2>Planificacion de las materias</h2>
    <form method="POST" action='periodos_view.php' id="register">

        <label for="first-name">Materias
            <select name="materia" class="select">
                <?php 
                $sql = "select p.id_ano, m.id, m.materia from pensum p inner join materia m on p.id_materia = m.id where p.id_ano = $ano";
                $ano_total = mysqli_query($db, $sql);
                while($anos = mysqli_fetch_assoc($ano_total)):
                ?> 
                <option value="<?=$anos['id']?>"><?=$anos['materia']?></option>
                <?php endwhile ?>
            </select>
    
    </label>
    <!-- VALIDAR CAMPOS -->

        <label for="last-name">Cantidad de evaluaciones<input id="last-name" name="evaluaciones" type="number" min= "1" max="5" value="1" required /></label>
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'evaluacion'): '';?>
        <label for="cedula">Lapso <input type="number" name="lapso" min='1' max='3' value="1" />
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'lapso'): '';?></label>
        <label for="">Periodo
            <?=$_SESSION['periodos']['periodo']?>
            </label>
    <label for="send"><input type="submit" value="Registrar" id="submitForm" /></label> 
    <input type="hidden" name="ano" value="<?=$ano?>"/>
   
    
    
    </form>

<?php 
borrarErrores();
require_once 'templeat/footer.php';
?>