<?php
require('fpdf186/fpdf.php');
include("../database/connection.php");

if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $pdf = new FPDF('P', 'mm', 'A4'); 
    $pdf->SetFont('Arial', '', 12); 
    generateInvoicePDF($pdf, $order_id);
} else {
    echo "Order ID not provided.";
}


function generateInvoicePDF($pdf, $order_id) {
    global $conn;

    $order_query = "SELECT o.*, p.name AS name, s.first_name AS first_name, 
                    s.last_name AS last_name, by.address AS address, by.pin_code AS pin_code, by.full_name AS buyer_name, by.contact_no AS contact
                    FROM order_details o
                    INNER JOIN buyer_details `by` ON o.buyer_id = `by`.buyer_id
                    INNER JOIN product_details p ON o.product_id = p.product_id
                    INNER JOIN seller_details s ON o.seller_id = s.seller_id
                    WHERE o.order_id = '$order_id'";
    $order_result = mysqli_query($conn, $order_query);

    while ($order_row = mysqli_fetch_assoc($order_result)) {
        $pdf->AddPage();

        $x = 10;
        $y = 1;
        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(71 ,5,'',0,0);
        $pdf->Image('../images/homelogo.png', $x, $y, 40); 

        $pdf->Ln();
        $pdf->Ln();

        $pdf->Ln();
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(71 ,10,'',0,0);
        $pdf->Cell(59 ,5,'Invoice',0,0);
        $pdf->Cell(59 ,10,'',0,1);

        $pdf->Ln();

        // Seller details
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(71 ,5,'Seller Details',0,1); // Move to next line after seller details
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(30 ,5,'Seller Name:',0,0);
        $pdf->Cell(8);
        $pdf->Cell(59 ,5,$order_row['first_name'] . ' ' . $order_row['last_name'],0,1); // Move to next line after seller name

        $pdf->Ln();

        // Customer details
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(71 ,5,'Customer Details',0,1); // Move to next line after customer details
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(30 ,5,'Customer Name:',0,0);
        $pdf->Cell(8); // Add space before the name
        $pdf->Cell(54 ,5,$order_row['buyer_name'],0,1); // Move to next line after customer name
        $pdf->Cell(30 ,5,'Contact Number:',0,0);
        $pdf->Cell(8);
        $pdf->Cell(59 ,5,$order_row['contact'],0,1); // Move to next line after contact number
        $pdf->Cell(30 ,5,'Shipping  Address:',0,0);
        $pdf->Cell(8); // Adjust the width of the empty cell to control spacing
        $pdf->Cell(54 ,5,$order_row['address'].' '.$order_row['pin_code'],0,1); // Move to next line after customer name
        $pdf->Cell(30 ,5,'Order Number:',0,0);
        $pdf->Cell(8);
        $pdf->Cell(59 ,5,$order_row['order_no'],0,1); // Move to next line after order number
        $pdf->Cell(30 ,5,'Order Date:',0,0);
        $pdf->Cell(8);
        $pdf->Cell(59 ,5,$order_row['order_date'],0,1);

        $pdf->Ln();
        $pdf->Ln();

        // heading of the table
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10 ,6,'S1',1,0,'C');
        $pdf->Cell(80 ,6,'Name',1,0,'C');
        $pdf->Cell(23 ,6,'Qty',1,0,'C');
        $pdf->Cell(30 ,6,'Unit Price',1,0,'C');
        $pdf->Cell(20 ,6,'Delivery',1,0,'C');
        $pdf->Cell(25 ,6,'Total',1,1,'C');

        $pdf->setFont('Arial', '', 10);

        // Output table data
        $pdf->Cell(10, 6, 1, 1, 0);
        $pdf->Cell(80, 6, $order_row['name'], 1, 0);
        $pdf->Cell(23, 6, $order_row['quantity'], 1, 0, 'R');
        $pdf->Cell(30, 6, $order_row['price'], 1, 0, 'R');
        $pdf->Cell(20, 6, ($order_row['price'] < 150) ? "20" : "Free", 1, 0, 'R');

        $totalPrice = $order_row['price'] * $order_row['quantity'];
        if ($totalPrice < 150) {
            $totalPrice += 20; // Add shipping charge if applicable
        }
        
        $pdf->Cell(25, 6, $totalPrice, 1, 1, 'R');

        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(25, 6, 'Subtotal', 0, 0);
        $pdf->Cell(45, 6, $totalPrice, 1, 1, 'R');

        $pdf->Ln();$pdf->Ln();
        $pdf->Ln();$pdf->Ln();
        $pdf->Ln();$pdf->Ln();
        
        
        
        $pdf->Image('../images/signature.png', $x + 105, $y + 155, 130); 
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
       
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(141 ,10,'',0,0);
        $pdf->Cell(99 ,5,'_________________',0,0);
        $pdf->Cell(59 ,10,'',0,1);

        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(141 ,10,'',0,0);
        $pdf->Cell(99 ,5,'Authorize Signature',0,0);
        $pdf->Cell(59 ,10,'',0,1);
        
        $pdf->Output();
    }
}
?>
