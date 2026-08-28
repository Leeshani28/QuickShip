<?php

include_once '../model/branch_model.php';

$branchObj = new Branch();
$result = $branchObj->getBranchDistrictReport();

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("Branch Distribution by District Report");

$date = date("Y-m-d");

$fpdf->AddPage();


// HEADER

$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"BRANCH DISTRIBUTION BY DISTRICT REPORT",0,1,"C");

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
    "BRANCH DISTRIBUTION BY DISTRICT REPORT",
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

$fpdf->Cell(25,10,"ID",1,0,"C",true);
$fpdf->Cell(70,10,"Branch Name",1,0,"C",true);
$fpdf->Cell(75,10,"District",1,1,"C",true);


// DATA

$fpdf->SetFont("Arial","",10);

$total = 0;
$districtSummary = array();

while($row = $result->fetch_assoc())
{
    $fpdf->SetX($startX);

    $fpdf->Cell(25,10,$row["branch_id"],1,0,"C");
    $fpdf->Cell(70,10,$row["branch_name"],1,0,"L");
    $fpdf->Cell(75,10,$row["district_name"],1,1,"L");

    if(isset($districtSummary[$row["district_name"]]))
    {
        $districtSummary[$row["district_name"]]++;
    }
    else
    {
        $districtSummary[$row["district_name"]] = 1;
    }

    $total++;
}


// SUMMARY

$fpdf->Ln(8);

$fpdf->SetFont("Arial","B",12);
$fpdf->Cell(0,8,"District Summary",0,1,"L");

$tableWidth = 120;
$startX = (210-$tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(70,10,"District",1,0,"C",true);
$fpdf->Cell(50,10,"No. of Branches",1,1,"C",true);

$fpdf->SetFont("Arial","",10);

foreach($districtSummary as $district=>$count)
{
    $fpdf->SetX($startX);

    $fpdf->Cell(70,10,$district,1,0,"L");
    $fpdf->Cell(50,10,$count,1,1,"C");
}

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",10);
$fpdf->Cell(70,10,"Total Branches",1,0,"L",true);
$fpdf->Cell(50,10,$total,1,1,"C");


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