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

    $this->Cell(70,10, 'Materia', 0,0,'C', 0);
    $this->Cell(75,10, 'Notas', 0,0,'C', 0);
    $this->Cell(30,10, 'Promedios', 0,1,'C', 0);
}

}

if (isset($_GET['lapso'])) {
    $id_alumno = $_GET['alumno'];
    $lapso = $_GET['lapso'];

    $sqlM = "select DISTINCT m.materia, n.id_pensum, AVG(n.nota) as notas from notas n inner join pensum p on n.id_pensum = p.id inner join materia m on m.id = p.id_materia where n.id_alumno = $id_alumno and n.lapso = $lapso GROUP by n.lapso, n.id_pensum;";
    $resultadoM = mysqli_query($db, $sqlM);

}
$pdf = new PDF();
$pdf ->AddPage();
$pdf->SetFont('Arial','',16);
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
    $pdf ->Cell(20,10, $promedio,1,1,'C',0);
    }


    $pdf->Output();

?>