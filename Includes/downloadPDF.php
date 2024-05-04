<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['customer_id'])) {
        header("Location: loginPage.php");
        exit;
    }

    // Include the FPDF library
    require('./fpdf.php');
    define('FPDF_FONTPATH', './font/');

    // Include the database connection
    require('./connection.php');

    // Create a new instance of the connection class
    $connection = new connection();

    // Get the database connection
    $conn = $connection->getConnection();

    // Create a new PDF instance with custom page size
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();

    // Set left and right margins
    $pdf->SetLeftMargin(20);
    $pdf->SetRightMargin(20);

    // Add logo
    $pdf->Image('../IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (1).png', 85, 10, 40);
    $pdf->Ln(45);

    // Company details
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, '~ SK CLOTHING ~', 0, 1, 'C');
    $pdf->Cell(0, 10, 'wijesingha building complex 13/16,Hospital junction,Polonnaruwa.', 0, 1, 'C');
    $pdf->Cell(0, 10, 'sk.clothingpolonnaruwa@gmail.com', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Phone: +94-716692627', 0, 1, 'C');
    $pdf->Ln(5);

    // Set font for the title
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Thank You for Your Purchase!', 0, 1, 'C');
    $pdf->Ln(2); // Add some space between the text and the line
    $pdf->SetLineWidth(0.5); // Set the line width
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Draw a line at the current Y position

    $pdf->SetFont('Arial', '', 12);

    // Add customer name outside the table
    $pdf->SetFont('Arial', 'B', 15); // Set font size to 15px
    $pdf->Cell(0, 10, 'Customer Name: ' . $_SESSION['customer_name'], 0, 1, 'C');
    $pdf->Ln(2); // Add some space between the customer name and the table

    // Add order details table header
    $pdf->SetFont('Arial', 'B', 12); // Set font size to 10px for the table header
    $pdf->Cell(50, 10, 'Item Name', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Size', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Price', 1, 0, 'C');
    $pdf->Cell(20, 10, 'Qty', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Subtotal', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Order Date', 1, 1, 'C');

    // Define the time range for filtering (e.g., last minute)
    $currentTime = time();
    $oneMinuteAgo = $currentTime - 60; // 60 seconds = 1 minute

    // Fetch data from the database using prepared statements
    $stmt = $conn->prepare("SELECT * FROM orders WHERE customer_name = ? AND order_time >= FROM_UNIXTIME(?) ORDER BY order_time DESC");
    $stmt->execute(array($_SESSION['customer_name'], $oneMinuteAgo));

    // Initialize total price
    $totalPrice = 0;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Add table row
        $pdf->SetFont('Arial', '', 10); // Set font size to 10px for table content
        $pdf->Cell(50, 10, $row['item_name'], 1, 0, 'C');
        $pdf->Cell(20, 10, $row['size'], 1, 0, 'C');
        $pdf->Cell(20, 10, $row['price'], 1, 0, 'C');
        $pdf->Cell(20, 10, $row['quantity'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['subtotal'], 1, 0, 'C');
        $pdf->Cell(35, 10, $row['order_date'], 1, 1, 'C');

        // Calculate subtotal for each item and add to total price
        $subtotal = $row['price'] * $row['quantity'];
        $totalPrice += $subtotal;
    }

    // Add line before displaying total price
    $pdf->Ln(5);
    $pdf->SetLineWidth(0.5);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

    // Display total price
    $pdf->SetFont('Arial', 'B', 12); // Set font size to 12px for total price
    $pdf->Cell(140, 10, 'Total Price:', 0, 0, 'R');
    $pdf->Cell(30, 10, 'Rs.' . number_format($totalPrice, 2), 0, 1, 'R');

    // Output the PDF as a download
    $pdf->Output('D', 'bill.pdf');

    // Redirect to index.php
    header("Location: index.php");
    exit;
?>
