<?php

include_once '../model/vehicle_model.php';

$vehicleObj = new Vehicle();
$result = $vehicleObj->getMaintenanceVehicles();

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("L","mm","A4");

$fpdf->SetTitle("Maintenance Vehicles Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"MAINTENANCE VEHICLES REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);
$fpdf->Line(10,30,287,30);
$fpdf->Ln(8);



// REPORT TITLE


$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);

$fpdf->Cell(
    0,
    10,
    "VEHICLES UNDER MAINTENANCE",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);



// TABLE HEADER


$tableWidth = 220;
$startX = (297-$tableWidth)/2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(20,10,"#",1,0,"C",true);
$fpdf->Cell(50,10,"Vehicle No",1,0,"C",true);
$fpdf->Cell(55,10,"Vehicle Type",1,0,"C",true);
$fpdf->Cell(40,10,"Capacity (kg)",1,0,"C",true);
$fpdf->Cell(55,10,"Branch",1,1,"C",true);



// TABLE DATA


$fpdf->SetFont("Arial","",11);

$count = 1;

while($row = $result->fetch_assoc())
{

    $fpdf->SetX($startX);

    $fpdf->Cell(20,10,$count,1,0,"C");

    $fpdf->Cell(
        50,
        10,
        $row["vehicle_number"],
        1,
        0,
        "C"
    );

    $fpdf->Cell(
        55,
        10,
        $row["vehicle_type"],
        1,
        0,
        "L"
    );

    $fpdf->Cell(
        40,
        10,
        number_format($row["vehicle_capacity"]),
        1,
        0,
        "C"
    );

    $fpdf->Cell(
        55,
        10,
        $row["branch_name"],
        1,
        1,
        "L"
    );

    $count++;
}



// TOTAL


$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(245,245,245);

$fpdf->Cell(
    165,
    10,
    "TOTAL VEHICLES UNDER MAINTENANCE",
    1,
    0,
    "R",
    true
);

$fpdf->Cell(
    55,
    10,
    number_format($count-1),
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