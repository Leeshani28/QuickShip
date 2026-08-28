<?php

include_once '../model/delivery_model.php';

$from_date  = $_GET["from_date"];
$to_date    = $_GET["to_date"];
$district_id = $_GET["district_id"];

$deliveryObj = new Delivery();

$result = $deliveryObj->getMonthlyDeliveryReport(
            $from_date,
            $to_date,
            $district_id
          );

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");

$fpdf->SetTitle("Monthly Delivery Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"MONTHLY DELIVERY REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);
$fpdf->Line(10,30,200,30);
$fpdf->Ln(8);



// DATE RANGE


$fpdf->SetFont("Arial","B",11);

$fpdf->Cell(30,8,"From Date :");
$fpdf->SetFont("Arial","",11);
$fpdf->Cell(45,8,$from_date);

$fpdf->SetFont("Arial","B",11);
$fpdf->Cell(25,8,"To Date :");
$fpdf->SetFont("Arial","",11);
$fpdf->Cell(45,8,$to_date);

$fpdf->Ln(12);



// REPORT TITLE


$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);

$fpdf->Cell(
    0,
    10,
    "MONTHLY DELIVERY SUMMARY",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);



// TABLE HEADER


$tableWidth = 120;
$startX = (210-$tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(60,10,"Month",1,0,"C",true);
$fpdf->Cell(60,10,"Total Deliveries",1,1,"C",true);



// DATA


$fpdf->SetFont("Arial","",11);

$total = 0;

while($row = $result->fetch_assoc())
{

    $fpdf->SetX($startX);

    $month = date("F Y", strtotime($row["delivery_month"]."-01"));

    $fpdf->Cell(
        60,
        10,
        $month,
        1,
        0,
        "C"
    );

    $fpdf->Cell(
        60,
        10,
        number_format($row["total_deliveries"]),
        1,
        1,
        "C"
    );

    $total += $row["total_deliveries"];

}



// GRAND TOTAL


$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);

$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(
    60,
    10,
    "TOTAL",
    1,
    0,
    "R",
    true
);

$fpdf->Cell(
    60,
    10,
    number_format($total),
    1,
    1,
    "C",
    true
);



// FOOTER


$fpdf->Ln(12);

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