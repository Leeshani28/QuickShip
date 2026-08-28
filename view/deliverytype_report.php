<?php

include_once '../model/warehouse_model.php';
include '../commons/fpdf186/fpdf.php';

$warehouseObj = new Warehouse();

$deliveryResult = $warehouseObj->getDeliveryTypeSummary();

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("Delivery Type Report");

$date = date("Y-m-d");

$fpdf->AddPage();


// HEADER 

$fpdf->Image("../images/logo2new.png",10,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"DELIVERY TYPE REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);

$fpdf->Line(10,32,200,32);

$fpdf->Ln(8);


// REPORT TITLE 

$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);

$fpdf->Cell(0,10,"PARCELS BY DELIVERY TYPE",0,1,"C",true);

$fpdf->Ln(5);


// TABLE 

$tableWidth = 120;

$startX = (210 - $tableWidth) / 2;

$typeWidth = 80;
$countWidth = 40;

$total = 0;

$fpdf->SetX($startX);

$fpdf->SetFillColor(230,230,230);
$fpdf->SetFont("Arial","B",11);

$fpdf->Cell($typeWidth,10,"Delivery Type",1,0,"C",true);
$fpdf->Cell($countWidth,10,"Parcels",1,1,"C",true);

$fpdf->SetFont("Arial","",11);

while($row = $deliveryResult->fetch_assoc())
{
    $fpdf->SetX($startX);

    $fpdf->Cell($typeWidth,9,$row["delivery_type"],1,0);

    $fpdf->Cell($countWidth,9,$row["total_parcels"],1,1,"C");

    $total += $row["total_parcels"];
}


// TOTAL 

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);

$fpdf->Cell($typeWidth,10,"Total Parcels",1,0);

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