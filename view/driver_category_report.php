<?php

include_once '../model/driver_model.php';
include '../commons/fpdf186/fpdf.php';

$driverObj = new Driver();

$statusResult = $driverObj->getDriverCategory();

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("Driver Category Report");

$date = date("Y-m-d");

$fpdf->AddPage();


// HEADER 

$fpdf->Image("../images/logo2new.png",10,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"DRIVER CATEGORY REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);

$fpdf->Line(10,32,200,32);

$fpdf->Ln(8);


// TITLE 

$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);

$fpdf->Cell(0,10,"DRIVER CATEGORY REPORT",0,1,"C",true);

$fpdf->Ln(5);


// TABLE 

$tableWidth = 120;

$startX = (210-$tableWidth)/2;

$statusWidth = 80;
$countWidth = 40;

$total = 0;

$fpdf->SetX($startX);

$fpdf->SetFillColor(230,230,230);
$fpdf->SetFont("Arial","B",11);

$fpdf->Cell($statusWidth,10,"Driver Category",1,0,"C",true);
$fpdf->Cell($countWidth,10,"No. of Drivers",1,1,"C",true);

$fpdf->SetFont("Arial","",11);

while($row=$statusResult->fetch_assoc())
{

    $fpdf->SetX($startX);

    $fpdf->Cell($statusWidth,9,$row["driver_categary"],1,0);

    $fpdf->Cell($countWidth,9,$row["total_drivers"],1,1,"C");

    $total += $row["total_drivers"];

}


// TOTAL 

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);

$fpdf->Cell($statusWidth,10,"Total Drivers",1,0);

$fpdf->Cell($countWidth,10,$total,1,1,"C");


// FOOTER 

$fpdf->Ln(15);

$fpdf->SetFont("Arial","I",9);

$fpdf->Cell(
    0,
    6,
    "This is a computer generated document and requires no authorized signature.",
    0,
    1,
    "C"
);

$fpdf->Output();

?>