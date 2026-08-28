<?php

include_once '../model/finance_model.php';

$financeObj = new Finance();

$from_date = $_GET["from_date"];
$to_date = $_GET["to_date"];
$district_id = $_GET["district_id"];

$result = $financeObj->getExpenseReport($from_date,$to_date,$district_id);

$totalResult = $financeObj->getExpenseTotal($from_date,$to_date,$district_id);
$totalRow = $totalResult->fetch_assoc();

$totalExpense = $totalRow["total_expense"];

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("L","mm","A4");

$fpdf->SetTitle("Expense Report");

$date = date("Y-m-d");

$fpdf->AddPage();

//header

$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"EXPENSE REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Period : ".$from_date." to ".$to_date,0,1,"L");
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);
$fpdf->Line(10,30,287,30);
$fpdf->Ln(8);

//report title

$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);

$fpdf->Cell(
    0,
    10,
    "EXPENSE REPORT",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);

//table header

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(55,10,"Category",1,0,"C",true);
$fpdf->Cell(90,10,"Description",1,0,"C",true);
$fpdf->Cell(40,10,"Amount (Rs.)",1,0,"C",true);
$fpdf->Cell(45,10,"Status",1,0,"C",true);
$fpdf->Cell(50,10,"Expense Date",1,1,"C",true);

//data

$fpdf->SetFont("Arial","",10);

while($row = $result->fetch_assoc())
{
    $fpdf->Cell(55,10,$row["expense_category"],1);
    $fpdf->Cell(90,10,$row["expense_description"],1);
    $fpdf->Cell(40,10,number_format($row["expense_amount"],2),1,0,"R");
    $fpdf->Cell(45,10,$row["expense_status"],1,0,"C");
    $fpdf->Cell(50,10,$row["expense_date"],1,1,"C");
}

//grand total
$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(145,10,"TOTAL EXPENSE",1,0,"R",true);
$fpdf->Cell(40,10,number_format($totalExpense,2),1,0,"R",true);
$fpdf->Cell(95,10,"",1,1,true);

//footer

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