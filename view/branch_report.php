<?php

include_once '../model/branch_model.php';

$branchObj = new Branch();

$branch_id = base64_decode($_GET["branch_id"]);

$result = $branchObj->getBranchForReport($branch_id);
$row = $result->fetch_assoc();

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");

$fpdf->SetTitle("Branch Details Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"BRANCH DETAILS REPORT",0,1,"C");

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
    "BRANCH INFORMATION",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(6);



// BRANCH DETAILS


$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(60,10,"Field",1,0,"C",true);
$fpdf->Cell(130,10,"Information",1,1,"C",true);

$fpdf->SetFont("Arial","",10);

$fpdf->Cell(60,10,"Branch Name",1,0);
$fpdf->Cell(130,10,$row["branch_name"],1,1);

$fpdf->Cell(60,10,"District",1,0);
$fpdf->Cell(130,10,$row["district_name"],1,1);

$fpdf->Cell(60,10,"Address",1,0);
$fpdf->MultiCell(130,10,$row["branch_address"],1);

$fpdf->Cell(60,10,"Contact Number",1,0);
$fpdf->Cell(130,10,$row["contact_no"],1,1);

$fpdf->Cell(60,10,"Email",1,0);
$fpdf->Cell(130,10,$row["email"],1,1);

$fpdf->Cell(60,10,"Status",1,0);
$fpdf->Cell(130,10,$row["branch_status"],1,1);



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