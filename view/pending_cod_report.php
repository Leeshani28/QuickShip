<?php
include_once '../commons/session.php';
include_once '../model/finance_model.php';

$financeObj = new Finance();

$userrow = $_SESSION["user"];
$district_id = $userrow["user_location"];

$result = $financeObj->getPendingCODPayments($district_id);

$totalResult = $financeObj->getPendingCODTotal($district_id);
$totalRow = $totalResult->fetch_assoc();
$totalPending = $totalRow["total_pending"];

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");

$fpdf->SetTitle("Pending COD Payments Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"PENDING COD PAYMENTS REPORT",0,1,"C");

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
    "PENDING COD PAYMENTS",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);



// TABLE


$tableWidth = 180;
$startX = (210-$tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(25,10,"Order ID",1,0,"C",true);
$fpdf->Cell(75,10,"Customer",1,0,"C",true);
$fpdf->Cell(40,10,"Amount (Rs.)",1,0,"C",true);
$fpdf->Cell(40,10,"Date",1,1,"C",true);



// DATA


$fpdf->SetFont("Arial","",11);

while($row = $result->fetch_assoc())
{
    $fpdf->SetX($startX);

    $fpdf->Cell(25,10,$row["order_id"],1,0,"C");

    $fpdf->Cell(75,10,$row["customer_name"],1);

    $fpdf->Cell(
        40,
        10,
        number_format($row["amount"],2),
        1,
        0,
        "R"
    );

    $fpdf->Cell(
        40,
        10,
        $row["payment_date"],
        1,
        1,
        "C"
    );
}



// GRAND TOTAL


$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(
    100,
    10,
    "TOTAL PENDING COD",
    1,
    0,
    "R",
    true
);

$fpdf->Cell(
    40,
    10,
    "Rs. ".number_format($totalPending,2),
    1,
    0,
    "R",
    true
);

$fpdf->Cell(
    40,
    10,
    "",
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