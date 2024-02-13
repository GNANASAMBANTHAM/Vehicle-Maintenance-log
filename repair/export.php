<?php
// Include TCPDF library
include "config.php";
require_once '../TCPDF-main/tcpdf.php';

// Create a new TCPDF object
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Gnanasambantham S');
$pdf->SetTitle('Repair Data');
$pdf->SetSubject('Repair Data');
$pdf->SetKeywords('TCPDF, PDF, Repair, data');

// Add a page
$pdf->AddPage();

// Set some content to the PDF
$pdf->SetFont('dejavusans', '', 12); // Use a font that supports UTF-8 characters
// Get starting and ending dates from the database
$sql_dates = "SELECT MAX(date) AS end_date FROM repair";
$result_dates = $conn->query($sql_dates);

// Check if the query was successful
if ($result_dates->num_rows > 0) {
    $row_dates = $result_dates->fetch_assoc();
    $end_date = $row_dates['end_date'];
} else {
    $end_date = "N/A";
}

// Set the start date as '2021-10-24'
$start_date = ' - ';
$end_date_formatted = date('d-m-Y', strtotime($end_date));
$html = '<div style="text-align:center;"><br>';
$html .= '<span style="font-weight:bold;">SANTRO XING TN10H7713</span> <br><br> ';
$html .= 'Repair / Maintenance Details <br><br>';
$html .= '<span style="font-family:dejavusans; font-weight:bold;"> From </span>' . $start_date . '<span style="font-weight:bold;"> To </span>' . $end_date_formatted;
$html .= '</div><br>';
$pdf->WriteHTML($html);

// SQL query to fetch data from the "fuel" table
$sql = "SELECT * FROM repair";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
    $pdf->Cell(15, 10, 'S.No', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Date', 1, 0, 'C');
    $pdf->Cell(30, 10, 'KM', 1, 0, 'C');
    $pdf->Cell(90, 10, 'Problem', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Amount', 1, 0, 'C');
    $pdf->Ln(); // Move to the next line

    // Output table data
    $counter = 1;
    $grand_total = 0;
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(15, 13, $counter, 1, 0, 'C');
        $pdf->Cell(30, 13, !empty($row['date']) ? date('d-m-Y', strtotime($row['date'])) : '-', 1, 0, 'C');
        $pdf->Cell(30, 13, $row['km'], 1, 0, 'C');
        $problemHTML = nl2br(htmlspecialchars($row['problem'])); // Convert newlines to <br> and escape HTML characters
    
        // Output the "Problem" cell using writeHTMLCell()
        $pdf->writeHTMLCell(90, 13, '', '', $problemHTML, 1, 0, false, true, 'C');
        $pdf->Cell(30, 13, '₹ ' . $row['amount'], 1, 0, 'C');
        $pdf->Ln(); // Move to the next line
        $counter++;
        $grand_total += $row['amount'];
    }
    // Output grand total
    $pdf->Cell(165, 13, 'Grand Total', 1, 0, 'C');
    $pdf->Cell(30, 13, '₹ ' . $grand_total, 1, 0, 'C');
    $pdf->Ln(); // Move to the next line
    

} else {
    // No rows found in the "fuel" table
    $pdf->Cell(0, 10, 'No data found', 1, 1, 'C');
}

// Close the database connection
$conn->close();

// Get the current date
$current_date = date('d-m-Y');

// Set headers for download with the file name including the current date
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="fuel_data ' . $current_date . '.pdf"');
header('Cache-Control: max-age=0');
// Add a line at the bottom of the page
$pdf->SetLineStyle(array('width' => 0.1, 'color' => array(0, 0, 0))); // Set line style
$pdf->Line(10, $pdf->getPageHeight() - 10, $pdf->getPageWidth() - 10, $pdf->getPageHeight() - 10); // Draw line

// Close and output PDF document
$pdf->Output('fuel_data ' . $current_date . '.pdf', 'D');


?>