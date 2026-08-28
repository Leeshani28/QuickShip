<?php

include_once '../model/package_model.php';

$packageObj = new Package();
$result = $packageObj->getFragilePackageReport();

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("Fragile vs Non-Fragile Packages Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"FRAGILE VS NON-FRAGILE PACKAGES REPORT",0,1,"C");

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
    "FRAGILE VS NON-FRAGILE PACKAGES",
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

$fpdf->Cell(30,10,"Package ID",1,0,"C",true);
$fpdf->Cell(55,10,"Package Type",1,0,"C",true);
$fpdf->Cell(35,10,"Weight (kg)",1,0,"C",true);
$fpdf->Cell(50,10,"Fragile Item",1,1,"C",true);



// DATA


$fpdf->SetFont("Arial","",10);

$total = 0;
$fragile = 0;
$nonFragile = 0;

while($row = $result->fetch_assoc())
{
    $fpdf->SetX($startX);

    $status = ($row["fragile_item"]) ? "Yes" : "No";

    if($row["fragile_item"])
        $fragile++;
    else
        $nonFragile++;

    $fpdf->Cell(30,10,$row["package_id"],1,0,"C");
    $fpdf->Cell(55,10,$row["pkg_type"],1,0,"L");
    $fpdf->Cell(35,10,number_format($row["pkg_weight"],2),1,0,"C");
    $fpdf->Cell(50,10,$status,1,1,"C");

    $total++;
}



// SUMMARY


$fpdf->Ln(8);

$tableWidth = 90;
$startX = (210-$tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(45,10,"Total Fragile",1,0,"L",true);
$fpdf->Cell(45,10,$fragile,1,1,"C");

$fpdf->SetX($startX);
$fpdf->Cell(45,10,"Total Non-Fragile",1,0,"L",true);
$fpdf->Cell(45,10,$nonFragile,1,1,"C");

$fpdf->SetX($startX);
$fpdf->Cell(45,10,"Total Packages",1,0,"L",true);
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