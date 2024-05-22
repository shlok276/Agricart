<?php
    require('D:\XAMPP\htdocs\Test\generatePDF.php');

    $pdf = new FPDF('p', 'mm', "A4"); $pdf->AddPage();$pdf->SetFont('Arial', 'B', 20);

    $pdf->Cell(71, 10, '',0,0);
    $pdf->Cell(59, 5, 'Invoice',0,0);
    $pdf->Cell(59, 10,'',0,1);

    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Cell(71, 10, '',0,0);
    $pdf->Cell(59, 5, 'WET',0,0);
    $pdf->Cell(59, 10,'Details',0,1);

    $pdf->Cell(130, 5, 'City',0,0);
    $pdf->Cell(25, 5, 'Invoice Date',0,0);
    $pdf->Cell(34, 5,'12th Jan 2019',0,1);
    
    $pdf->Cell(130, 5, '',0,0);
    $pdf->Cell(25, 5, 'Invoice No:',0,0);
    $pdf->Cell(34, 5,'ORD001',0,1);

    $pdf->SetFont('Arial', '', 20);
    $pdf->Cell(25, 5, 'Bill To:',0,0);
    $pdf->Cell(34, 5,'',0,1);
    
    $pdf->Output()
?>







// function generateInvoicePDF($order_id) {
//     // Create new PDF instance
//     $pdf = new FPDF();
//     $pdf->AddPage();

//     // Set font
//     $pdf->SetFont('Arial', '', 12);

//     // Add a title
//     $pdf->Cell(0, 10, 'Invoice for Order ID: ' . $order_id, 0, 1, 'C');

//     // Add some content
//     $pdf->Cell(0, 10, 'This is a sample invoice content. You can customize it as needed.', 0, 1);

    

//     // Output PDF to browser
//     $pdf->Output('invoice.pdf', 'D'); // 'D' to force download

//     // Terminate further execution
//     exit;
// }

// // Check if order_id is provided and call the function to generate the PDF
// if(isset($_GET['order_id'])) {
//     $order_id = $_GET['order_id'];
//     generateInvoicePDF($order_id);
// } else {
//     // Handle case where order_id is not provided
//     echo "Order ID not provided.";
// }