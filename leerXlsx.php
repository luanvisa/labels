<?php /** @noinspection MultiAssignmentUsageInspection */

use Shuchkin\SimpleXLSX;
require_once __DIR__.'/simplexlsx/src/SimpleXLSX.php';

require('fpdf/fpdf.php'); // Asegúrate de que la ruta sea correcta

$nombreClub="C.F.Nules";//Nombre del club para titulo del pdf y club en la etiqueta

// Cargar el archivo Excel
if ($xlsx = SimpleXLSX::parse('excel/nules.xlsx')) {
    // Crear un objeto PDF
    $pdf = new FPDF('L', 'mm', array(70,37));
    $pdf->SetTitle($nombreClub);

    // Establecer la codificación a UTF-8

    // Iterar a través de las filas y generar el contenido del PDF
    foreach ($xlsx->rows() as $row) {
        // Agregar una nueva página para cada fila
        $pdf->AddPage();

        //Estila la pagina

        // Seleccionar solo las columnas
        $cellA = isset($row[0]) ? $row[0] : ''; // Columna A
        $cellB = isset($row[1]) ? $row[1] : ''; // Columna B
        $cellC = isset($row[2]) ? $row[2] : ''; // Columna C
        $cellD = isset($row[3]) ? $row[3] : ''; // Columna D
        $cellE = isset($row[4]) ? $row[4] : ''; // Columna E

        // Personalizar las celdas como lo desees
        $pdf->SetFont('Arial','B',10);
        $pdf->Text((70-$pdf->GetStringWidth($nombreClub))/2, 9, $nombreClub);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Text((70-$pdf->GetStringWidth($cellA))/2, 13, iconv('UTF-8', 'ISO-8859-1', $cellA));
        $pdf->SetFont('Arial', '', 7);
        $pdf->Text((70-$pdf->GetStringWidth($cellB))/2, 17, iconv('UTF-8', 'ISO-8859-1', $cellB));
        $pdf->Text((70-$pdf->GetStringWidth($cellC." - ".$cellD))/2, 21, iconv('UTF-8', 'ISO-8859-1', $cellC." - ".$cellD));
        $pdf->Text((70-$pdf->GetStringWidth($cellE))/2, 24, iconv('UTF-8', 'ISO-8859-1', $cellE));

    }
    // Generar el PDF y mostrarlo en el navegador
    $pdf->Output('D', $nombreClub.'.pdf');
} else {
    echo SimpleXLSX::parseError();
}

?>
