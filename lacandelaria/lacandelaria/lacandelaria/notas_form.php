<?php  
require_once 'model/conexion.php';
require_once 'helpers/funciones.php';
session_start();

$materia = $_POST['materia'];
$ano = $_POST['ano'];

if ($_POST['pensum']) {
    $pensum = $_POST['pensum'];
    
}
//convirtiendo string en enteros
$cantidad = (int)$_POST['cantidad_notas'];
$lapso = (int)$_POST['lapso'];


$url = "notas_view.php";
$url .= "?materia=" .urlencode($materia);
$url .= "&ano=" .urlencode($ano);
$url .= "&lapso=" .urlencode($lapso);
$url .= "&filas=" .urlencode($cantidad);

   
    if (isset($_POST['pensum']) && !empty($_POST['pensum']) ) {
        $pensum = $_POST['pensum'];
    }else{
        echo 'error3';
    }
    
    if (isset($_POST['alumno']) && !empty($_POST['alumno'])) {
        $alumno =$_POST['alumno']; 
    }else{
        echo 'error4';
    }
    
           
            if (existeNota($db, $alumno, $pensum)) {
            
        
       
                for($i = 1; $i <= $cantidad; $i++){

                  $idnota_total = $_POST['idnota'.$i];
                  $nota_total = $_POST['nota'.$i];

                  $sql = "update notas set id_alumno = '$alumno',id_pensum = '$pensum',nota = '$nota_total', lapso = '$lapso_validada' where id = $idnota_total;";
                  $guardar = mysqli_query($db, $sql);
                  }
                  if ($guardar == true) {
                    $_SESSION['guardado']['exito'] = 'Nota Editada';
                    header("Location: " . $url);
                    exit();
                }else{
                    $_SESSION['guardado']['error'] = 'fallo al editar la nota';
                    header("Location: " . $url);
                    exit();
                }
                
               
            }else{
                for ($i=1; $i<=$cantidad; $i++) { 
                   $nota_total = $_POST['nota'.$i]; 
                    
                    $sql = "insert into notas values(null, '$alumno', '$pensum', '$nota_total', '$lapso_validada')";
                    $guardar = mysqli_query($db, $sql);
                }
                if ($guardar == true) {
                    $_SESSION['guardado']['exito'] = 'Nota registrada';
                    header("Location: " . $url);
                    exit();
                }else{
                    $_SESSION['guardado']['error'] = 'fallo al registrar nota';
                    header("Location: " . $url);
                    exit();
                }
                

        }
        
    

    

?>


