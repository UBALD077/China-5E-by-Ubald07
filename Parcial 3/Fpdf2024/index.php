<?php
require('fpdf186/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'Hola papus :v',0,2);

$pdf->SetFont('Times','I',20);
$pdf->SetTextColor(50,10,100);
$pdf->SetFillColor(220,100,2);
$pdf->Cell(190,40,'Centro de Estudios Tecnologicos Industriales y de Servicios No.84','LR',3,'C',true);

$pdf->SetFont('Courier','',18);
$pdf->SetTextColor(50,10,200);
$pdf->Cell(40,10,'Desarolla Aplicaciones con Conexion a Base de Datos',0,1);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(130,10,'Torres Grijalva Ubaldo Yamil',0,'c',true);

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(40,100,40);
$pdf->Cell(120,10,'Gabriel Ignacio China Cortez',0,'c',true);
$pdf->Output();
?>