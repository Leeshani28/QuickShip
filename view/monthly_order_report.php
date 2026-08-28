<?php

include_once '../model/order_model.php';

$orderObj = new Order();

$from = $_GET["from_date"];
$to   = $_GET["to_date"];

$result = $orderObj->getMonthlyOrderReport($from, $to);

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("L","mm","A4");

$fpdf->SetTitle("Monthly Order Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",20);
$fpdf->Cell(0,12,"MONTHLY ORDER REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);
$fpdf->Line(10,30,287,30);
$fpdf->Ln(8);



// REPORT PERIOD


$fpdf->SetFont("Arial","B",12);
$fpdf->Cell(40,8,"Report Period",0,1);

$fpdf->SetFont("Arial","",11);
$fpdf->Cell(30,8,"From Date",0,0);
$fpdf->Cell(5,8,":",0,0);
$fpdf->Cell(40,8,$from,0,1);

$fpdf->Cell(30,8,"To Date",0,0);
$fpdf->Cell(5,8,":",0,0);
$fpdf->Cell(40,8,$to,0,1);

$fpdf->Ln(5);



// REPORT TITLE


$fpdf->SetFont("Arial","B",13);
$fpdf->Cell(0,10,"ORDER DETAILS",0,1,"C");

$fpdf->Ln(2);



// TABLE


$tableWidth = 260;
$startX = (297-$tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(20,10,"Order ID",1,0,"C",true);
$fpdf->Cell(60,10,"Sender",1,0,"C",true);
$fpdf->Cell(45,10,"Package Type",1,0,"C",true);
$fpdf->Cell(45,10,"Destination",1,0,"C",true);
$fpdf->Cell(40,10,"Delivery Date",1,0,"C",true);
$fpdf->Cell(50,10,"Status",1,1,"C",true);



// DATA


$fpdf->SetFont("Arial","",10);

$totalOrders = 0;

while($row = $result->fetch_assoc())
{

    $fpdf->SetX($startX);

    $fpdf->Cell(20,9,$row["order_id"],1,0,"C");

    $fpdf->Cell(60,9,$row["customer_name"],1,0,"L");

    $fpdf->Cell(45,9,$row["pkg_type"],1,0,"L");

    $fpdf->Cell(45,9,$row["branch_name"],1,0,"L");

    $fpdf->Cell(40,9,$row["preferred_del_date"],1,0,"C");

    $fpdf->Cell(50,9,$row["status_name"],1,1,"C");

    $totalOrders++;

}



// SUMMARY


$fpdf->Ln(8);

$summaryWidth = 120;
$summaryX = (297-$summaryWidth)/2;

$fpdf->SetX($summaryX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(70,10,"Summary",1,0,"C",true);
$fpdf->Cell(50,10,"Value",1,1,"C",true);

$fpdf->SetFont("Arial","",11);

$fpdf->SetX($summaryX);
$fpdf->Cell(70,10,"Report Period",1,0);
$fpdf->Cell(50,10,$from." to ".$to,1,1,"C");

$fpdf->SetX($summaryX);
$fpdf->Cell(70,10,"Total Orders",1,0);
$fpdf->Cell(50,10,$totalOrders,1,1,"C");



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