<?php
// Include TCPDF library
require_once('D/software/xampp/htdocs/User/Agricart/pdf_makker/libraries/tcpdf/tcpdf.php');

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Sample PDF');
$pdf->SetSubject('Sample PDF Document');
$pdf->SetKeywords('TCPDF, PDF, example, sample');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Add a page
$pdf->AddPage();

// Set some content
$html = '<h1>Sample PDF</h1>';
$html .= '<p>This is a sample PDF document generated using TCPDF library.</p>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Add more pages or content as needed

// Close and output PDF document
$pdf->Output('sample.pdf', 'I'); // 'I' for inline rendering, 'F' to save to file, 'D' to force download
?>
