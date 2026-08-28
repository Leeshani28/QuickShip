<?php

include_once '../model/branch_model.php';

$branchObj = new Branch();
$result = $branchObj->getBranchList();

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");

$fpdf->SetTitle("Branch List Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"BRANCH LIST REPORT",0,1,"C");

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
    "BRANCH LIST",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);



// TABLE HEADER


$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(45,10,"Branch",1,0,"C",true);
$fpdf->Cell(40,10,"District",1,0,"C",true);
$fpdf->Cell(35,10,"Contact",1,0,"C",true);
$fpdf->Cell(45,10,"Email",1,0,"C",true);
$fpdf->Cell(25,10,"Status",1,1,"C",true);



// TABLE DATA


$fpdf->SetFont("Arial","",9);

$total = 0;

while($row = $result->fetch_assoc())
{

    $fpdf->Cell(
        45,
        10,
        $row["branch_name"],
        1,
        0,
        "L"
    );

    $fpdf->Cell(
        40,
        10,
        $row["district_name"],
        1,
        0,
        "L"
    );

    $fpdf->Cell(
        35,
        10,
        $row["contact_no"],
        1,
        0,
        "C"
    );

    $fpdf->Cell(
        45,
        10,
        $row["email"],
        1,
        0,
        "L"
    );

    $fpdf->Cell(
        25,
        10,
        $row["branch_status"],
        1,
        1,
        "C"
    );

    $total++;
}



// GRAND TOTAL


$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(
    165,
    10,
    "TOTAL BRANCHES",
    1,
    0,
    "R",
    true
);

$fpdf->Cell(
    25,
    10,
    number_format($total),
    1,
    1,
    "C",
    true
);



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