<?php

include_once '../model/package_model.php';

$packageObj = new Package();
$result = $packageObj->getPackageList();


include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");

$fpdf->SetTitle("Package List Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"PACKAGE LIST REPORT",0,1,"C");

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
    "PACKAGE LIST",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);



// TABLE


$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(20,10,"Pkg ID",1,0,"C",true);
$fpdf->Cell(20,10,"Order ID",1,0,"C",true);
$fpdf->Cell(50,10,"Package Type",1,0,"C",true);
$fpdf->Cell(35,10,"Package Weight",1,0,"C",true);
$fpdf->Cell(35,10,"Fragile Item",1,0,"C",true);
$fpdf->Cell(20,10,"Quantity",1,1,"C",true);



// DATA


$fpdf->SetFont("Arial","",9);

$total = 0;

while($row = $result->fetch_assoc())
{

    $fpdf->Cell(
        20,
        10,
        $row["package_id"],
        1,
        0,
        "C"
    );

    $fpdf->Cell(
        20,
        10,
        $row["order_id"],
        1,
        0,
        "C"
    );

    $fpdf->Cell(
        50,
        10,
        $row["pkg_type"],
        1,
        0,
        "C"
    );

    $fpdf->Cell(
        35,
        10,
        $row["pkg_weight"],
        1,
        0,
        "C"
    );

    $fpdf->Cell(
        35,
        10,
        $row["fragile_item"],
        1,
        0,
        "L"
    );
    $fpdf->Cell(
        20,
        10,
        $row["quantity"],
        1,
        1,
        "L"
    );

    $total++;
}



// GRAND TOTAL


$fpdf->SetFont("Arial","B",10);

$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(
    135,
    10,
    "TOTAL PACKAGES",
    1,
    0,
    "R",
    true
);

$fpdf->Cell(
    55,
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