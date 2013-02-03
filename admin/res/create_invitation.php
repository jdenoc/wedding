<?php   // create_invitation.php (ADMIN)
require_once('fpdf17/fpdf.php');
require_once('../../res/connection.php');
$db = new pdo_connection('jdenocco_wedding');
$pdf = new FPDF();

//<link href='http://fonts.googleapis.com/css?family=Petit+Formal+Script' rel='stylesheet' type='text/css'>

$pdf->AddPage();
// Column widths
$pdf->SetFont('Arial','B',12);
$w = 92.5;
$h = 125;

// TABLE
$pdf->Cell($w,$h,'',1);     // CELL 1
$pdf->Cell(5,$h,'');
$pdf->Cell($w,$h,'',1);     // CELL 2
$pdf->Ln();
$pdf->Cell(5,10,'');
$pdf->Ln();
$pdf->Cell($w,$h,'',1);     // CELL 3
$pdf->Cell(5,$h,'');
$pdf->Cell($w,$h,'',1);     // CELL 4
$pdf->Ln();

// Cell 1
$pdf->Text(35, 40, "Denis & Britain O'Connor");
$pdf->Image("../../imgs/invite/seperator.jpg", 27.5, 45, 60);
$pdf->Text(10, 60, "Request the honor of your presence: October 19, 2013");
$pdf->Text(20, 70, "Please RSVP at http://wedding.jdenoc.com/RSVP");
$pdf->Text(30, 80, "using code: XXXXX");
$pdf->Text(40, 90, "by July 15, 2013.");
$pdf->Image("../../imgs/invite/seperator.jpg", 27.5, 105, 60);


// Cell 2
$pdf->Image("../../imgs/invite/background.png", 105, 25, 95, 95);

// Cell 3
$pdf->Image("../../imgs/invite/background.png", 10, 160, 95, 95);

// Cell 4
$pdf->Image("../../imgs/invite/background.png", 105, 160, 95, 95);

$pdf->Output();
?>