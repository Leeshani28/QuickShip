<?php

// Include the User Model to access user data from the database
include_once '../model/user_model.php';

// Create an object of the User class
$userObj = new User();

// Get all users from the database
$userResult = $userObj->getAllUsers();


// Include the FPDF library
// This library is used to generate PDF documents using PHP
include '../commons/fpdf186/fpdf.php';


// Create a new PDF object
// "P" = Portrait orientation
// Other option: "L" = Landscape
$fpdf = new FPDF("P");


// Set the title of the PDF document
// This title is stored in the PDF properties
$fpdf->SetTitle("User Report");


// Get today's date
$date = date("Y-m-d");


// Add a new page to the PDF
// Parameters:
// "P" = Portrait
// "A4" = Paper size
$fpdf->AddPage("P", "A4");


// Set the font
// Parameters:
// Font Family = Arial
// Font Style = "" (Normal)
// Font Size = 18
$fpdf->SetFont("Arial", "", 18);

// Set font size (same as above, can be changed later)
$fpdf->SetFontSize(18);


// Add an image (company logo)
// Parameters:
// Image Path
// X Position = 10
// Y Position = 20
// Width = 20
// Height = 20
$fpdf->Image("../images/logo.png", 10, 20, 20, 20);


// Create the report title
// Cell(width, height, text, border, next line, alignment)
//
// width = 0 (Automatically use remaining page width)
// height = 30
// border = 0 (No border)
// next line = 1 (Move to next line after printing)
// alignment = C (Center)
$fpdf->Cell(0, 30, "USER REPORT", 0, 1, "C");


// Change font size for normal text
$fpdf->SetFontSize(12);

// Print report description
$fpdf->Cell(0, 30, "The System Users as of $date are as below", 0, 1, "L");



/* =====================================================
   TABLE HEADER
   ===================================================== */

// First column
// Width = 60
// Height = 10
// Border = 1
// Stay on same line = 0
// Align Center
$fpdf->Cell(60, 10, "Name", 1, 0, "C");

// Second column
$fpdf->Cell(80, 10, "Email", 1, 0, "C");

// Third column
// Last parameter = 1 means move to the next line
$fpdf->Cell(40, 10, "Status", 1, 1, "C");



/* =====================================================
   TABLE DATA
   ===================================================== */

// Loop through every user retrieved from the database
while ($userrow = $userResult->fetch_assoc())
{
    // Convert database status to readable text
    $status = ($userrow["user_status"] == "1") ? "Active" : "Deactive";

    // Print user's full name
    $fpdf->Cell(
        60,
        10,
        $userrow['user_fname'] . " " . $userrow['user_lname'],
        1,
        0,
        "C"
    );

    // Slightly reduce font size for long email addresses
    $fpdf->SetFontSize(11);

    // Print email
    $fpdf->Cell(
        80,
        10,
        $userrow['user_email'],
        1,
        0,
        "C"
    );

    // Return font size to normal
    $fpdf->SetFontSize(12);

    // Print account status
    // Move to next line after printing
    $fpdf->Cell(
        40,
        10,
        $status,
        1,
        1,
        "C"
    );
}



/* =====================================================
   FOOTER NOTE
   ===================================================== */

// Smaller font size
$fpdf->SetFontSize(10);

// Print footer note
$fpdf->Cell(
    0,
    10,
    "This is a computer generated document and requires no authorized signature",
    0,
    1,
    "L"
);



/* =====================================================
   OUTPUT PDF
   ===================================================== */

// Display the generated PDF in the browser
$fpdf->Output();

?>