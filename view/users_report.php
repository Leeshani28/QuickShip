<?php
include_once '../model/user_model.php';
$userObj = new User();
$userResult = $userObj->getAllUsersForReports();

include '../commons/fpdf186/fpdf.php';

$fpdf = new FPDF("P","mm","A4");
$fpdf->SetTitle("Users Report");

$date = date("Y-m-d");

$fpdf->AddPage();

// HEADER 
$fpdf->Image("../images/logo2new.png",15,10,28);

$fpdf->SetFont("Arial","B",20);
$fpdf->Cell(0,12,"USERS REPORT",0,1,"C");

$fpdf->SetFont("Arial","",10);
$fpdf->Cell(0,6,"Generated Date : ".$date,0,1,"R");

$fpdf->Ln(2);
$fpdf->Line(10,30,200,30);
$fpdf->Ln(8);

// SECTION TITLE 
$fpdf->SetFillColor(220,220,220);
$fpdf->SetFont("Arial","B",13);
$fpdf->Cell(0,10,"USERS LIST",1,1,"C",true);

$fpdf->Ln(5);

// TABLE 

// Center the table
$tableWidth = 180;
$startX = (210 - $tableWidth) / 2;

$fpdf->SetX($startX);

$fpdf->SetFont("Arial","B",11);
$fpdf->SetFillColor(230,230,230);

$fpdf->Cell(45,10,"Full Name",1,0,"C",true);
$fpdf->Cell(65,10,"Email",1,0,"C",true);
$fpdf->Cell(45,10,"Role",1,0,"C",true);
$fpdf->Cell(25,10,"Status",1,1,"C",true);

// DATA 

$fpdf->SetFont("Arial","",10);

while($userrow = $userResult->fetch_assoc())
{
    $status = ($userrow["user_status"]=="1") ? "Active" : "Deactive";

    $fpdf->SetX($startX);

    $fpdf->Cell(45,9,
        $userrow['user_fname']." ".$userrow['user_lname'],
        1,0,"L");

    $fpdf->Cell(65,9,
        $userrow['user_email'],
        1,0,"L");

    $fpdf->Cell(45,9,
        $userrow['role_name'],
        1,0,"L");

    $fpdf->Cell(25,9,
        $status,
        1,1,"C");
}

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