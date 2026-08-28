<?php

include_once '../model/warehouse_model.php';
include '../commons/fpdf186/fpdf.php';

$from_date = $_GET["from_date"];
$to_date   = $_GET["to_date"];

$warehouseObj = new Warehouse();

$result = $warehouseObj->getShipmentSummaryReport($from_date,$to_date);

$pdf = new FPDF("P","mm","A4");
$pdf->SetTitle("Shipment Summary Report");

$pdf->AddPage();

$date = date("Y-m-d");


// HEADER 

$pdf->Image("../images/logo2new.png",10,10,28);

$pdf->SetFont("Arial","B",18);
$pdf->Cell(0,12,"SHIPMENT SUMMARY REPORT",0,1,"C");

$pdf->SetFont("Arial","",10);
$pdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$pdf->Ln(2);

$pdf->Line(10,32,200,32);

$pdf->Ln(8);


// REPORT PERIOD 

$pdf->SetFillColor(220,220,220);
$pdf->SetFont("Arial","B",12);

$pdf->Cell(0,9,"Report Period",1,1,"C",true);

$pdf->SetFont("Arial","",11);

$pdf->Cell(0,8,"From : ".$from_date."    To : ".$to_date,1,1,"C");

$pdf->Ln(5);


// TABLE 

$pdf->SetFillColor(230,230,230);
$pdf->SetFont("Arial","B",10);

$pdf->Cell(30,10,"Shipment ID",1,0,"C",true);
$pdf->Cell(35,10,"Date",1,0,"C",true);
$pdf->Cell(75,10,"Destination Branch",1,0,"C",true);
$pdf->Cell(40,10,"Parcels",1,1,"C",true);

$pdf->SetFont("Arial","",10);

$totalShipments = 0;
$totalParcels = 0;

while($row = $result->fetch_assoc())
{
    $pdf->Cell(30,8,$row["shipment_id"],1);
    $pdf->Cell(35,8,$row["shipment_date"],1);
    $pdf->Cell(75,8,$row["branch_name"],1);
    $pdf->Cell(40,8,$row["total_parcels"],1,1,"C");

    $totalShipments++;
    $totalParcels += $row["total_parcels"];
}


// SUMMARY 

$pdf->Ln(8);

$pdf->SetFont("Arial","B",11);

$pdf->Cell(60,8,"Total Shipments",1,0);
$pdf->Cell(30,8,$totalShipments,1,1,"C");

$pdf->Cell(60,8,"Total Parcels",1,0);
$pdf->Cell(30,8,$totalParcels,1,1,"C");


// FOOTER 

$pdf->Ln(12);

$pdf->SetFont("Arial","I",9);

$pdf->Cell(
    0,
    6,
    "This is a computer generated document and requires no authorized signature.",
    0,
    1,
    "C"
);

$pdf->Output();

?>