<?php

include_once '../model/package_model.php';

$packageObj = new Package();
$result = $packageObj->getPackageWeightDistribution();

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("Package Weight Distribution Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",16);
$fpdf->Cell(0,12,"PACKAGE WEIGHT DISTRIBUTION REPORT",0,1,"C");

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
    "PACKAGE WEIGHT DISTRIBUTION",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);



// TABLE


$tableWidth = 120;
$startX = (210 - $tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(70,10,"Weight Range",1,0,"C",true);
$fpdf->Cell(50,10,"Total Packages",1,1,"C",true);



// DATA


$fpdf->SetFont("Arial","",11);

$total = 0;

while($row = $result->fetch_assoc())
{
    $fpdf->SetX($startX);

    $fpdf->Cell(
        70,
        10,
        $row["weight_range"],
        1,
        0,
        "L"
    );

    $fpdf->Cell(
        50,
        10,
        number_format($row["total_packages"]),
        1,
        1,
        "C"
    );

    $total += $row["total_packages"];
}



// GRAND TOTAL


$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(
    70,
    10,
    "TOTAL PACKAGES",
    1,
    0,
    "R",
    true
);

$fpdf->Cell(
    50,
    10,
    number_format($total),
    1,
    1,
    "C",
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