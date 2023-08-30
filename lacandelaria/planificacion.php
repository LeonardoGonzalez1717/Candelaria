<?php 
require_once 'templeat/header.php';

    $query = "SELECT ano.id, ano.ano, seccion.seccion FROM ano left join seccion on seccion.id = ano.id_seccion";
	$resultado= mysqli_query($db, $query);
?>
<?php if (isset($_SESSION['guardado'])): ?>
        <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['guardado']; ?>
      </div>
      <?php elseif(isset($_SESSION['alerta'])): ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['alerta']; ?>
      </div>
      <?php endif; ?>
      <!--Funcion de js/ajax para detectar el cambio de año-->
      <script language="javascript">
			$(document).ready(function(){
				$("#cbx_ano").change(function () {

					// $('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
					$("#cbx_ano option:selected").each(function () {
						id_ano = $(this).val();
                        console.log(id_ano);
						$.post("getMateria.php", { id_ano: id_ano }, function(data){
							$("#cbx_materia").html(data);
						});            
					});
				})
			});

		</script>
<h2>Planificacion de las materias</h2>
    <form method="POST" action='periodos_view.php' id="register">

        <label for="first-name">Año
            <select name="ano" id="cbx_ano" class="select">
				<option value="0">Seleccionar Año</option>
				<?php while($row = $resultado->fetch_assoc()) { ?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['ano'].' '.$row['seccion']; ?></option>
				<?php } ?>
			</select>
    
    </label>
    <label for="">Materias
     <select name="materia" id="cbx_materia" class="select"></select>
    </label>


        <label for="last-name">Cantidad de evaluaciones<input id="last-name" name="evaluaciones" type="number" min= "1" max="5" value="1" required /></label>
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'evaluacion'): '';?>
        <label for="cedula">Lapso <input type="number" name="lapso" min='1' max='3' value="1" />
        <?php echo isset($_SESSION['alertas']) ? mostrarErrores($_SESSION['alertas'], 'lapso'): '';?></label>
        <label for="">Periodo
            <?=$_SESSION['periodos']['periodo']?>
            </label>
    <label for="send"><input type="submit" value="Registrar" id="submitForm" /></label> 
    
   
    
    
    </form>

<?php 
borrarErrores();
require_once 'templeat/footer.php';
?>