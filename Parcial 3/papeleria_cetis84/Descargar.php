<?php
require('pdf/fpdf.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "papeleria_cetis84";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT ID_PRODUCTO, NOMBRE_PRODUCTO, DESCRIPCION, PRECIO FROM productos";
$result = $conn->query($sql);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Lista de Productos', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'ID', 1, 0, 'C');
$pdf->Cell(60, 10, 'Nombre', 1, 0, 'C');
$pdf->Cell(60, 10, 'Descripcion', 1, 0, 'C');
$pdf->Cell(30, 10, 'Precio', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, $row['ID_PRODUCTO'], 1, 0);
        $pdf->Cell(60, 10, $row['NOMBRE_PRODUCTO'], 1, 0);
        $pdf->Cell(60, 10, $row['DESCRIPCION'], 1, 0);
        $pdf->Cell(30, 10, '$' . number_format($row['PRECIO'], 2), 1, 1, 'R');
    }
} else {
    $pdf->Cell(0, 10, 'No hay productos disponibles', 1, 1, 'C');
}

$conn->close();
$pdf->Output('D', 'Tabla_Productos.pdf');
?>