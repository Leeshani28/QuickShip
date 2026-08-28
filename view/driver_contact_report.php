<?php

include_once '../model/driver_model.php';
include '../commons/fpdf186/fpdf.php';

$driverObj = new Driver();

$driverResult = $driverObj->getDriverContactReport();

$fpdf = new FPDF("L","mm","A4");
$fpdf->SetTitle("Driver Contact List Report");

$date = date("Y-m-d");

$fpdf->AddPage();


// HEADER 

$fpdf->Image("../images/logo2new.png",10,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"DRIVER CONTACT LIST REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);

$fpdf->Line(10,32,287,32);

$fpdf->Ln(8);


// TITLE 

$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);

$fpdf->Cell(0,10,"DRIVER CONTACT LIST",0,1,"C",true);

$fpdf->Ln(5);


// TABLE 

$tableWidth = 240;

$startX = (297-$tableWidth)/2;

$idWidth = 20;
$nameWidth = 70;
$phoneWidth = 45;
$districtWidth = 60;
$categoryWidth = 35;
$statusWidth = 30;

$total = 0;

$fpdf->SetX($startX);

$fpdf->SetFillColor(230,230,230);
$fpdf->SetFont("Arial","B",11);

$fpdf->Cell($idWidth,10,"Driver ID",1,0,"C",true);
$fpdf->Cell($nameWidth,10,"Driver Name",1,0,"C",true);
$fpdf->Cell($phoneWidth,10,"Phone Number",1,0,"C",true);
$fpdf->Cell($districtWidth,10,"Branch",1,0,"C",true);
$fpdf->Cell($categoryWidth,10,"Category",1,0,"C",true);
$fpdf->Cell($statusWidth,10,"Status",1,1,"C",true);

$fpdf->SetFont("Arial","",10);

while($row = $driverResult->fetch_assoc())
{

    $fpdf->SetX($startX);

    $fpdf->Cell($idWidth,9,$row["driver_id"],1,0);
    $fpdf->Cell($nameWidth,9,$row["driver_name"],1,0);
    $fpdf->Cell($phoneWidth,9,$row["driver_phone_number"],1,0,"C");
    $fpdf->Cell($districtWidth,9,$row["branch_name"],1,0);
    $fpdf->Cell($categoryWidth,9,$row["driver_categary"],1,0,"C");
    $fpdf->Cell($statusWidth,9,$row["driver_status"],1,1,"C");

    $total++;

}


// TOTAL 

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);

$fpdf->Cell(
    $idWidth + $nameWidth + $phoneWidth + $districtWidth + $categoryWidth,
    10,
    "Total Drivers",
    1,
    0,
    "R"
);

$fpdf->Cell($statusWidth,10,$total,1,1,"C");


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