<?php

include_once '../model/warehouse_model.php';
include '../commons/fpdf186/fpdf.php';

$from_date = $_GET["from_date"];
$to_date   = $_GET["to_date"];

$warehouseObj = new Warehouse();

$result = $warehouseObj->getIncomingDeliveriesReport($from_date,$to_date);

$pdf = new FPDF("P","mm","A4");
$pdf->SetTitle("Incoming Deliveries Report");

$pdf->AddPage();

$date = date("Y-m-d");

// HEADER 

$pdf->Image("../images/logo2new.png",10,10,28);

$pdf->SetFont("Arial","B",18);
$pdf->Cell(0,12,"INCOMING DELIVERIES REPORT",0,1,"C");

$pdf->SetFont("Arial","",10);
$pdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$pdf->Ln(2);

$pdf->Line(10,32,200,32);

$pdf->Ln(8);


// DATE RANGE 

$pdf->SetFillColor(220,220,220);
$pdf->SetFont("Arial","B",12);

$pdf->Cell(0,9,"Report Period",1,1,"C",true);

$pdf->SetFont("Arial","",11);

$pdf->Cell(0,8,"From : ".$from_date."    To : ".$to_date,1,1,"C");

$pdf->Ln(5);


// TABLE 

$pdf->SetFillColor(230,230,230);
$pdf->SetFont("Arial","B",10);

$pdf->Cell(18,10,"Order",1,0,"C",true);
$pdf->Cell(45,10,"Date",1,0,"C",true);
$pdf->Cell(30,10,"Package",1,0,"C",true);
$pdf->Cell(32,10,"Delivery",1,0,"C",true);
$pdf->Cell(40,10,"Branch",1,0,"C",true);
$pdf->Cell(25,10,"Status",1,1,"C",true);

$pdf->SetFont("Arial","",10);

$count = 0;

while($row = $result->fetch_assoc())
{
    $pdf->Cell(18,8,$row["order_id"],1);
    $pdf->Cell(45,8,$row["order_date"],1);
    $pdf->Cell(30,8,$row["pkg_type"],1);
    $pdf->Cell(32,8,$row["delivery_type"],1);
    $pdf->Cell(40,8,$row["branch_name"],1);
    $pdf->Cell(25,8,$row["status_name"],1,1);

    $count++;
}


// TOTAL 

$pdf->Ln(6);

$pdf->SetFont("Arial","B",11);

$pdf->Cell(45,8,"Total Incoming Parcels : ".$count,0,1);


// FOOTER 

$pdf->Ln(10);

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