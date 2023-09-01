<?php 
require_once 'model/conexion.php';
require_once 'fpdf/fpdf.php';

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
   
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(70,10, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Boletín estudiantil'),1,0,'C');
    // Salto de línea
    $this->Ln(20);
    if (isset($_GET['lapso']) && isset($_GET['alumno'])) {
        
        $this->Cell(70,10, 'Materia', 0,0,'C', 0);
        $this->Cell(75,10, 'Notas', 0,0,'C', 0);
        $this->Cell(30,10, 'Promedio', 0,1,'C', 0);
    }elseif(isset($_GET['alumno'])){
        $this->Cell(70,10, 'Materia', 0,0,'L', 0);
        $this->Cell(75,10, 'Notas finales', 0,0,'C', 0);
        $this->Cell(30,10, 'Promedio', 0,1,'R', 0);
    }
}

}

$pdf = new PDF();
$pdf ->AddPage();
$pdf->SetFont('Arial','',16);
if (isset($_GET['lapso']) && isset($_GET['alumno']) ) {
    $id_alumno = $_GET['alumno'];
    $lapso = $_GET['lapso'];

    $sqlM = "select DISTINCT m.materia, n.id_pensum, AVG(n.nota) as notas from notas n inner join pensum p on n.id_pensum = p.id inner join materia m on m.id = p.id_materia where n.id_alumno = $id_alumno and n.lapso = $lapso GROUP by n.lapso, n.id_pensum;";
    $resultadoM = mysqli_query($db, $sqlM);

while ($resultado = mysqli_fetch_assoc($resultadoM)) {
    $promedio = number_format($resultado['notas'], 2);
    $pdf->Cell(70,10, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $resultado['materia']), 1,0,'C', 0);
    $id_pensum = $resultado['id_pensum'];
    //notas una por una
    $sql = "select nota from notas where id_alumno = $id_alumno and id_pensum = $id_pensum and lapso = $lapso";
    $notas = mysqli_query($db, $sql);
    while($nota = mysqli_fetch_assoc($notas)){
        $pdf ->Cell(20,10, $nota['nota'],1,0,'C',0);
    }
    $pdf ->Cell(30,10, $promedio,1,1,'R',0);
}
}elseif (isset($_GET['alumno'])) {


    $id_alumno = $_GET['alumno'];
    $sqlM = "SELECT DISTINCT materia, id_pensum FROM notas n INNER JOIN pensum p on p.id = n.id_pensum INNER JOIN materia m on m.id = p.id_materia WHERE id_alumno = $id_alumno";
    $resultadoM = mysqli_query($db, $sqlM);
    while ($resultado = mysqli_fetch_assoc($resultadoM)) {
        $promedios_total = array();
        $id_pensum = $resultado['id_pensum'];

        $pdf->Cell(65,10, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $resultado['materia']), 1,0,'C', 0);

        $nota_final = "select avg(n.nota) as nota_final,m.materia from notas n inner join pensum p on p.id = n.id_pensum inner join materia m on p.id_materia = m.id where n.id_alumno = $id_alumno and n.id_pensum = $id_pensum group by n.lapso, n.id_pensum";
        $nota = mysqli_query($db, $nota_final);
        if (!empty($nota)) {
           while ($notas = mysqli_fetch_assoc($nota)){
            $notas_limitadas = number_format($notas['nota_final'], 2);
            $pdf->Cell(25,10, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $notas_limitadas), 1,0,'C', 0);
           }
        }
        $sql = "SELECT AVG(nota) AS promedio FROM notas where id_alumno = $id_alumno and id_pensum = $id_pensum GROUP BY id_pensum, lapso;"; 
        $promedios = mysqli_query($db, $sql);
        if (!empty($promedios)) {
        while($promedio = mysqli_fetch_assoc($promedios)){
            $promedios_total[] = $promedio['promedio'];
            $promedios_final = array_sum($promedios_total)/count($promedios_total);
        } 
     
    }
    $promedios_final = number_format($promedios_final, 2);
    $pdf->Cell(40,10, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $promedios_final), 1,1,'R', 0);
    }
    
}


    $pdf->Output();

?>