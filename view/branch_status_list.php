<?php

include_once '../model/branch_model.php';

$branchObj = new Branch();
$result = $branchObj->getBranchStatusReport();

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("Branch Status Summary Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"BRANCH STATUS SUMMARY REPORT",0,1,"C");

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
    "BRANCH STATUS SUMMARY REPORT",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);



// TABLE


$tableWidth = 170;
$startX = (210 - $tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(30,10,"Branch ID",1,0,"C",true);
$fpdf->Cell(55,10,"Branch Name",1,0,"C",true);
$fpdf->Cell(35,10,"Branch Status",1,1,"C",true);



// DATA


$fpdf->SetFont("Arial","",10);

$total = 0;
$active = 0;
$deactive = 0;

while($row = $result->fetch_assoc())
{
    $fpdf->SetX($startX);

    $status = ($row["branch_status"]);

    if($row["branch_status"] == 'Active')
        $active++;
    else
        $deactive++;

    $fpdf->Cell(30,10,$row["branch_id"],1,0,"C");
    $fpdf->Cell(55,10,$row["branch_name"],1,0,"L");
    $fpdf->Cell(35,10,$status,1,1,"C");

    $total++;
}



// SUMMARY


$fpdf->Ln(8);

$tableWidth = 90;
$startX = (210-$tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(45,10,"Total Active",1,0,"L",true);
$fpdf->Cell(45,10,$active,1,1,"C");

$fpdf->SetX($startX);
$fpdf->Cell(45,10,"Total De-Active",1,0,"L",true);
$fpdf->Cell(45,10,$deactive,1,1,"C");

$fpdf->SetX($startX);
$fpdf->Cell(45,10,"Total Branches",1,0,"L",true);
$fpdf->Cell(45,10,$total,1,1,"C");



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