<?php

include_once '../commons/session.php';
include_once '../model/finance_model.php';

$userrow = $_SESSION["user"];

$district_id = $userrow["user_location"];

$financeObj = new Finance();

$incomeResult = $financeObj->getMonthlyIncome($district_id);
$incomeRow = $incomeResult->fetch_assoc();
$totalIncome = $incomeRow["total_income"];

$expenseResult = $financeObj->getMonthlyExpense($district_id);
$expenseRow = $expenseResult->fetch_assoc();
$totalExpense = $expenseRow["total_expense"];

$totalProfit = $totalIncome - $totalExpense;

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("Monthly Profit Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"MONTHLY PROFIT REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);
$fpdf->Line(10,30,200,30);
$fpdf->Ln(8);



// REPORT TITLE


$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);

$fpdf->Cell(
    0,
    10,
    "MONTHLY FINANCIAL SUMMARY",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);



// TABLE


$tableWidth = 120;
$startX = (210-$tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(70,10,"Description",1,0,"C",true);
$fpdf->Cell(50,10,"Amount (Rs.)",1,1,"C",true);



// DATA


$fpdf->SetFont("Arial","",11);

$fpdf->SetX($startX);
$fpdf->Cell(70,10,"Monthly Income",1);
$fpdf->Cell(50,10,number_format($totalIncome,2),1,1,"R");

$fpdf->SetX($startX);
$fpdf->Cell(70,10,"Monthly Expenses",1);
$fpdf->Cell(50,10,number_format($totalExpense,2),1,1,"R");



// PROFIT


$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(
    70,
    10,
    "Monthly Profit",
    1,
    0,
    "R",
    true
);

$fpdf->Cell(
    50,
    10,
    number_format($totalProfit,2),
    1,
    1,
    "R",
    true
);



// FOOTER NOTE


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