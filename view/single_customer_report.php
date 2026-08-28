<?php

include_once '../model/customer_model.php';
include_once '../model/order_model.php';

$customerObj = new Customer();
$orderObj = new Order();

$customer_id = base64_decode($_GET["customer_id"]);

$result = $customerObj->getCustomer($customer_id);
$row = $result->fetch_assoc();

$customerOrderResult = $orderObj->getCustomerOrders($customer_id);

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");

$fpdf->SetTitle("Customer Details Report");

$date = date("Y-m-d");

$fpdf->AddPage();



// HEADER


$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"CUSTOMER DETAILS REPORT",0,1,"C");

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
    "CUSTOMER INFORMATION",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);



// CUSTOMER DETAILS


$tableWidth = 150;
$startX = (210 - $tableWidth)/2;

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

function detailRow($pdf, $startX, $label, $value)
{
    $pdf->SetX($startX);

    $pdf->SetFont("Arial","B",11);
    $pdf->Cell(50,10,$label,1,0,"L",true);

    $pdf->SetFont("Arial","",11);
    $pdf->Cell(100,10,$value,1,1,"L");
}

detailRow($fpdf,$startX,"Customer ID",$row["customer_id"]);
detailRow($fpdf,$startX,"Customer Name",$row["customer_name"]);
detailRow($fpdf,$startX,"Address",$row["customer_address"]);
detailRow($fpdf,$startX,"Email",$row["customer_email"]);
detailRow($fpdf,$startX,"NIC",$row["customer_nic"]);
detailRow($fpdf,$startX,"Mobile Number",$row["customer_mobile"]);
detailRow($fpdf,$startX,"Fixed Number",$row["customer_fixed"]);



$fpdf->Ln(10);

$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",11);

$fpdf->Cell(
    0,
    10,
    "CUSTOMER ORDER HISTORY",
    0,
    1,
    "C",
    true
);

$fpdf->Ln(5);

// Center the table
$tableWidth = 180;
$startX = (210 - $tableWidth) / 2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(15,10,"#",1,0,"C",true);
$fpdf->Cell(65,10,"Package Type",1,0,"C",true);
$fpdf->Cell(45,10,"Delivery Date",1,0,"C",true);
$fpdf->Cell(25,10,"Town",1,0,"C",true);
$fpdf->Cell(25,10,"Status",1,1,"C",true);

// DATA 

$fpdf->SetFont("Arial","",10);
while($customerOrderRow = $customerOrderResult->fetch_assoc())
{
    $fpdf->SetX($startX);

    
    $fpdf->Cell(15,9,
        $customerOrderRow['order_id'],
        1,0,"L");

    $fpdf->Cell(65,9,
        $customerOrderRow['pkg_type'],
        1,0,"L");

    $fpdf->Cell(45,9,
        $customerOrderRow['preferred_del_date'],
        1,0,"L");
    $fpdf->Cell(25,9,
        $customerOrderRow['town'],
        1,0,"L");

    $fpdf->Cell(25,9,
        $customerOrderRow['status_name'],
        1,1,"C");

}


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