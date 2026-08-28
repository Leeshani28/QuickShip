<?php

include_once '../model/delivery_model.php';

$from_date = $_GET["from_date"];
$to_date = $_GET["to_date"];
$district_id = $_GET["district_id"];

$deliveryObj = new Delivery();

$result = $deliveryObj->getCompletedDeliveryReport(
            $from_date,
            $to_date,
            $district_id
          );

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("L","mm","A4");

$fpdf->SetTitle("Completed Delivery Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"COMPLETED DELIVERY REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);
$fpdf->Line(10,30,287,30);
$fpdf->Ln(5);



// DATE RANGE


$fpdf->SetFont("Arial","B",11);

$fpdf->Cell(30,8,"From Date :");
$fpdf->SetFont("Arial","",11);
$fpdf->Cell(45,8,$from_date);

$fpdf->SetFont("Arial","B",11);
$fpdf->Cell(25,8,"To Date :");
$fpdf->SetFont("Arial","",11);
$fpdf->Cell(45,8,$to_date);

$fpdf->Ln(10);



// TABLE HEADER


$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(220,220,220);

$fpdf->Cell(15,10,"ID",1,0,"C",true);
$fpdf->Cell(30,10,"Date",1,0,"C",true);
$fpdf->Cell(45,10,"Start",1,0,"C",true);
$fpdf->Cell(45,10,"Destination",1,0,"C",true);
$fpdf->Cell(55,10,"Driver",1,0,"C",true);
$fpdf->Cell(40,10,"Vehicle",1,0,"C",true);
$fpdf->Cell(35,10,"Status",1,1,"C",true);



// DATA


$fpdf->SetFont("Arial","",10);

$total = 0;

while($row = $result->fetch_assoc())
{

    $fpdf->Cell(15,10,$row["delivery_id"],1);

    $fpdf->Cell(30,10,$row["delivery_date"],1);

    $fpdf->Cell(45,10,$row["start_location"],1);

    $fpdf->Cell(45,10,$row["destination_location"],1);

    $fpdf->Cell(55,10,$row["driver_name"],1);

    $fpdf->Cell(40,10,$row["vehicle_number"],1);

    $fpdf->Cell(35,10,$row["delivery_status"],1,1,"C");

    $total++;

}



// GRAND TOTAL


$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(230,10,"TOTAL COMPLETED DELIVERIES",1,0,"R",true);

$fpdf->Cell(35,10,$total,1,1,"C",true);



// FOOTER


$fpdf->Ln(10);

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