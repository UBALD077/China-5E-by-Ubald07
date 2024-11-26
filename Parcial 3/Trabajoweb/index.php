<?php

require('fpdf186/fpdf.php');

// Crear una instancia del objeto FPDF
$pdf = new FPDF();
$pdf->AddPage(); // Añadir una página al documento

// Establecer el tipo de letra y el tamaño
$pdf->SetFont('Arial', 'B', 16);


$pdf->Cell(200, 10, 'Tarea num 4', 0, 1, 'C');


$pdf->Ln(10);

// Datos del alumno
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Nombre del Alumno: ', 0, 0);
$pdf->Cell(0, 10, 'Ubaldo Yamil Torres Grijalva', 0, 1); 

$pdf->Cell(50, 10, 'Grado/Semestre: ', 0, 0);
$pdf->Cell(0, 10, '5°E', 0, 1); 


$pdf->Ln(10);

// Guardar el archivo PDF
$pdf->Output('D', 'Trabajoweb.pdf');
?>
