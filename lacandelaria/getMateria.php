<?php
	require_once 'model/conexion.php';
	
	$id_ano = $_POST['id_ano'];
	// $id_estado = "hola";
	
	// echo $id_estado;
	$queryM = "SELECT p.id_materia, m.materia FROM pensum p inner join materia m on m.id = p.id_materia WHERE p.id_ano = '$id_ano'";
	$resultadoM = mysqli_query($db, $queryM);
	
	$html= "<option value='0'>Seleccionar una materia</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['id_materia']."'>".$rowM['materia']."</option>";
	}
	
	echo $html;
?>