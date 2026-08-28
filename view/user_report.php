<?php
include_once '../model/user_model.php';
$userObj = new User();
$user_id=base64_decode($_GET["user_id"]);
$userResult=$userObj->getUser($user_id);
$userrow=$userResult->fetch_assoc();

$userContactResult=$userObj->getUserContact($user_id);
$contactrow1=$userContactResult->fetch_assoc();
$contactrow2=$userContactResult->fetch_assoc();

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("User Report");

$date = date("Y-m-d");

$fpdf->AddPage();

// HEADER 
$fpdf->Image("../images/logo2new.png",10,10,28);

$fpdf->SetFont("Arial","B",18);
$fpdf->Cell(0,12,"USER REPORT",0,1,"C");

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
$fpdf->Cell(0,10,"USER DETAILS",1,1,"C",true);

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

RowData($fpdf,"Full Name",$userrow['user_fname']." ".$userrow['user_lname'],$labelWidth,$valueWidth,$rowHeight,$startX);

RowData($fpdf,"Email",$userrow['user_email'],$labelWidth,$valueWidth,$rowHeight,$startX);

RowData($fpdf,"NIC",$userrow['user_nic'],$labelWidth,$valueWidth,$rowHeight,$startX);

RowData($fpdf,"Date of Birth",$userrow['user_dob'],$labelWidth,$valueWidth,$rowHeight,$startX);

RowData($fpdf,"Location",$userrow['branch_name'],$labelWidth,$valueWidth,$rowHeight,$startX);

RowData($fpdf,"Mobile Number",$contactrow1["contact_number"],$labelWidth,$valueWidth,$rowHeight,$startX);

RowData($fpdf,"Fixed Number",$contactrow2["contact_number"],$labelWidth,$valueWidth,$rowHeight,$startX);

RowData($fpdf,"Role",$userrow['role_name'],$labelWidth,$valueWidth,$rowHeight,$startX);

RowData($fpdf,"Status",$status,$labelWidth,$valueWidth,$rowHeight,$startX);

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