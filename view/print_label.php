<?php
include_once '../commons/session.php';
include_once '../model/order_model.php';

$userrow = $_SESSION["user"];

$orderObj = new Order();

$order_id=base64_decode($_GET["order_id"]);

$orderResult=$orderObj->getOrder($order_id);
$orderrow=$orderResult->fetch_assoc();

$OrderStatusLogResult=$orderObj->getOrderLogs($order_id);

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("Invoice");

$date = date("Y-m-d");

$fpdf->AddPage();

// HEADER 
$fpdf->Image("../images/logo2new.png",10,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"INVOICE",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);

// Header line
$fpdf->SetDrawColor(0,0,0);
$fpdf->Line(10,32,200,32);

$fpdf->Ln(8);

// USER DETAILS 

$status = ($userrow["user_status"]=="1") ? "Active" : "Deactive";

// Center heading
$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);
$fpdf->Cell(0,10,"Order#".$orderrow["order_id"],1,1,"C",true);

$fpdf->Ln(5);

// Center the table
$tableWidth = 160;          // 50 + 110
$startX = (210 - $tableWidth) / 2;
$fpdf->SetX($startX);

$labelWidth = 50;
$valueWidth = 110;
$rowHeight = 9;

function RowData($pdf,$label,$value,$labelWidth,$valueWidth,$rowHeight,$startX)
{
    $pdf->SetX($startX);

    // Label
    $pdf->SetFont("Arial","B",11);
    $pdf->SetFillColor(245,245,245);
    $pdf->Cell($labelWidth,$rowHeight,$label,1,0,"L",true);

    // Value
    $pdf->SetFont("Arial","",11);
    $pdf->Cell($valueWidth,$rowHeight,$value,1,1,"L");
}

RowData($fpdf,"Order Date",$orderrow["order_date"],$labelWidth,$valueWidth,$rowHeight,$startX);
RowData($fpdf,"Payment Type",$orderrow["payment_type"],$labelWidth,$valueWidth,$rowHeight,$startX);
RowData($fpdf,"Order Amount","Rs.".number_format($orderrow["amount"],2),$labelWidth,$valueWidth,$rowHeight,$startX);
RowData($fpdf,"Order Date",$orderrow["order_date"],$labelWidth,$valueWidth,$rowHeight,$startX);
RowData($fpdf,"Order Date",$orderrow["order_date"],$labelWidth,$valueWidth,$rowHeight,$startX);

$fpdf->Ln(10);
$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);
$fpdf->Cell(0,10,"Delivery Details",0,1,"C",true);

$fpdf->Ln(5);

RowData($fpdf,"Order Date",$orderrow["order_date"],30,50,9,30);
RowData($fpdf,"Order Date",$orderrow["order_date"],30,50,9,70);

// FOOTER NOTE 
$fpdf->Ln(15);

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