<?php include_once 'templeat/header.php';
if (!isset($_SESSION['usuario_admin']) && !isset($_SESSION['usuario_lector'])) {
    $_SESSION['alertas'] = 'Por favor introducir un usuario';
    header('location: login_form.php');
}

$query = "SELECT ano.id, ano.ano, seccion.seccion FROM ano left join seccion on seccion.id = ano.id_seccion";
$resultado= mysqli_query($db, $query);

if (isset($_SESSION['alerta']['plan'])): ?>
    <div class="alert alert-danger" role="alert">
    <?php echo $_SESSION['alerta']['plan']; ?>
  </div>
<?php endif;?>
<script language="javascript">
			$(document).ready(function(){
				$("#cbx_ano").change(function () {
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
<h2>Registro de notas</h2>
    <form method="POST" action='notas_view.php' id="register">
        <label for="first-name">Año
        <select name="ano" id="cbx_ano" class="select">
        <option value="0">Seleccionar Año</option>
             <?php 
            if(!empty($resultado)):
                 while ($row = mysqli_fetch_assoc($resultado)):
             ?>
                <option value="<?=$row['id']?>"><?=$row['ano'].' '. $row['seccion']?></option>`
                                            
                <?php 
            endwhile;
        endif;
        ?>
             </select>
        </label>
            
       
       
    <label for="">Materias
         <select name="materia" id="cbx_materia" class="select"></select>
    </label>

        <label for="age">Lapso   
            <select name="lapso" class="select">
                <option value="1">Lapso 1 </option>
                <option value="2">Lapso 2 </option>
                <option value="3">Lapso 3 </option>
            </select>
        
        </label>
        
            
            <input type="submit" value="Registrar" id="submitForm" />
           
    </form> 
                    
               
                               

<?php
include_once 'templeat/footer.php'; 
borrarErrores();

?>