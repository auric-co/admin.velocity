<?php
require('../fpdf.php');

class PDF extends FPDF
{
function Header()
{
    // Logo
   $this->Image('http://localhost/velocity/inclt/img/logo.jpg',65,6,70,'C');
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(70);
    // Title
    //$this->Cell(50,10,'Velocity Coupon',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    $url = "velocity.co.zw";
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
	$this->SetDrawColor(0,80,180);
	$this->SetFillColor(200,220,255);
	$this->SetTextColor(220,50,50);
	$this->SetFont('Arial','I',20);
    // Footer Text
	$this->Cell(0,10,$url,0,0,'C',true);
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
for($i=1;$i<=40;$i++)
	$pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>
