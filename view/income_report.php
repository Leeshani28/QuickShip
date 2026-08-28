<?php

include_once '../model/finance_model.php';

$financeObj = new Finance();

$from_date = $_GET["from_date"];
$to_date = $_GET["to_date"];
$district_id = $_GET["district_id"];

$result = $financeObj->getIncomeReport($from_date,$to_date,$district_id);

$totalResult = $financeObj->getIncomeTotal($from_date,$to_date,$district_id);
$totalRow = $totalResult->fetch_assoc();
$totalIncome = $totalRow["total_income"];

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("L","mm","A4");
$fpdf->SetTitle("Income Report");

$date = date("Y-m-d");

$fpdf->AddPage();

// HEADER

$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"INCOME REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Period : ".$from_date." to ".$to_date,0,1,"L");
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);
$fpdf->Line(10,30,287,30);
$fpdf->Ln(8);

// REPORT TITLE

$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);

$fpdf->Cell(0,10,"INCOME REPORT",0,1,"C",true);

$fpdf->Ln(5);

//TABLE

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(30,10,"Order ID",1,0,"C",true);
$fpdf->Cell(90,10,"Customer",1,0,"C",true);
$fpdf->Cell(45,10,"Payment Type",1,0,"C",true);
$fpdf->Cell(45,10,"Amount (Rs.)",1,0,"C",true);
$fpdf->Cell(55,10,"Payment Date",1,1,"C",true);

//DATA

$fpdf->SetFont("Arial","",10);

while($row = $result->fetch_assoc())
{
    $fpdf->Cell(30,10,$row["order_id"],1,0,"C");
    $fpdf->Cell(90,10,$row["customer_name"],1);
    $fpdf->Cell(45,10,$row["payment_type"],1,0,"C");
    $fpdf->Cell(45,10,number_format($row["amount"],2),1,0,"R");
    $fpdf->Cell(55,10,$row["payment_date"],1,1,"C");
}

//GRAND TOTAL

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(165,10,"TOTAL INCOME",1,0,"R",true);
$fpdf->Cell(45,10,number_format($totalIncome,2),1,0,"R",true);
$fpdf->Cell(55,10,"",1,1,true);

//FOOTER

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