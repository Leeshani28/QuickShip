<?php

include_once '../model/branch_model.php';

$from_date = $_GET["from_date"];
$to_date   = $_GET["to_date"];
$branch_id = $_GET["branch_id"];

$branchObj = new Branch();

$result = $branchObj->getBranchRevenueReport($from_date,$to_date,$branch_id);

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("Branch Revenue Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"BRANCH REVENUE REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);
$fpdf->Line(10,30,200,30);
$fpdf->Ln(5);



// FILTER DETAILS


$fpdf->SetFont("Arial","",10);

$fpdf->Cell(35,7,"From Date",0,0);
$fpdf->Cell(50,7,": ".$from_date,0,0);

$fpdf->Cell(25,7,"To Date",0,0);
$fpdf->Cell(40,7,": ".$to_date,0,1);

if($branch_id=="")
{
    $branch_name="All Branches";
}
else
{
    $branch_name = $branchObj->getBranchName($branch_id);
}

$fpdf->Cell(35,7,"Branch",0,0);
$fpdf->Cell(80,7,": ".$branch_name,0,1);

$fpdf->Ln(3);



// REPORT TITLE


$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);

$fpdf->Cell(0,10,"BRANCH REVENUE REPORT",0,1,"C",true);

$fpdf->Ln(5);



// TABLE


$tableWidth = 170;
$startX = (210-$tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(25,10,"Order ID",1,0,"C",true);
$fpdf->Cell(60,10,"Branch",1,0,"C",true);
$fpdf->Cell(40,10,"Date",1,0,"C",true);
$fpdf->Cell(45,10,"Amount (Rs.)",1,1,"C",true);



// DATA


$fpdf->SetFont("Arial","",10);

$totalRevenue = 0;
$totalOrders = 0;

while($row = $result->fetch_assoc())
{
    $fpdf->SetX($startX);

    $fpdf->Cell(25,10,$row["order_id"],1,0,"C");
    $fpdf->Cell(60,10,$row["branch_name"],1,0,"L");
    $fpdf->Cell(40,10,$row["payment_date"],1,0,"C");
    $fpdf->Cell(45,10,number_format($row["amount"],2),1,1,"R");

    $totalRevenue += $row["amount"];
    $totalOrders++;
}



// SUMMARY


$fpdf->Ln(8);

$tableWidth = 90;
$startX = (210-$tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(45,10,"Total Orders",1,0,"L",true);
$fpdf->Cell(45,10,$totalOrders,1,1,"C");

$fpdf->SetX($startX);

$fpdf->Cell(45,10,"Total Revenue",1,0,"L",true);
$fpdf->Cell(45,10,"Rs. ".number_format($totalRevenue,2),1,1,"R");



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