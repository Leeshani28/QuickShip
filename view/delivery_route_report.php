<?php

include_once '../model/delivery_model.php';

$deliveryObj = new Delivery();
$result = $deliveryObj->getDeliveryRouteReport();

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("Delivery Route Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"DELIVERY ROUTE REPORT",0,1,"C");

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
    "DELIVERY ROUTE REPORT",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);



// TABLE HEADER


$tableWidth = 180;
$startX = (210 - $tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(15,10,"#",1,0,"C",true);
$fpdf->Cell(60,10,"Start Location",1,0,"C",true);
$fpdf->Cell(60,10,"Destination Location",1,0,"C",true);
$fpdf->Cell(45,10,"Total Deliveries",1,1,"C",true);



// TABLE DATA


$fpdf->SetFont("Arial","",10);

$total = 0;
$no = 1;

while($row = $result->fetch_assoc())
{
    $fpdf->SetX($startX);

    $fpdf->Cell(
        15,
        10,
        $no++,
        1,
        0,
        "C"
    );

    $fpdf->Cell(
        60,
        10,
        $row["start_location"],
        1,
        0,
        "L"
    );

    $fpdf->Cell(
        60,
        10,
        $row["destination_location"],
        1,
        0,
        "L"
    );

    $fpdf->Cell(
        45,
        10,
        number_format($row["total_deliveries"]),
        1,
        1,
        "C"
    );

    $total += $row["total_deliveries"];
}



// GRAND TOTAL


$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",10);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(
    135,
    10,
    "TOTAL DELIVERIES",
    1,
    0,
    "R",
    true
);

$fpdf->Cell(
    45,
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