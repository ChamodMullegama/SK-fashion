<?php
session_start();

if (!isset($_SESSION['cartBW']) || empty($_SESSION['cartBW'])) {
    echo "<script>alert('Your shopping cart is empty.');</script>";
    echo "<script>window.location.href = './cart_BW_rent.php';</script>";
    exit;
}

$total = 0;
foreach ($_SESSION['cartBW'] as $cartItem) {
    $subtotal = $cartItem['price'] * $cartItem['quantity'];
    $total += $subtotal;
}

$_SESSION['total_bill'] = $total;

include_once './Includes/connection.php';

$database = new connection();
$conn = $database->getConnection();

$sql = "INSERT INTO rental_orders (customer_name, item_name, price, size, quantity, total, subtotal, date_ordered, start_date, end_date) VALUES (:customer_name, :item_name, :price, :size, :quantity, :total, :subtotal, :date_ordered, :start_date, :end_date)";
$stmt = $conn->prepare($sql);

$date_ordered = date("Y-m-d");

$customer_name = isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : '';

foreach ($_SESSION['cartBW'] as $cartItem) {
    if(isset($_SESSION['customer_name'])) {
        $item_name = $cartItem['productName'];
        $price = $cartItem['price'];
        $start_date = $cartItem['startDate'];
        $end_date = $cartItem['endDate'];
        $size = $cartItem['size'];
        $quantity = $cartItem['quantity'];
        $subtotal = $cartItem['price'] * $cartItem['quantity'];

        // Bind parameters
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':item_name', $item_name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':date_ordered', $date_ordered);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        
        if ($stmt->execute()) {
            unset($_SESSION['cartBW']);
        } else {}
    } else {
        // echo "<script>alert('Error: Customer name not set in session data.');";
        echo "<script>window.location='./loginPage.php';</script>";
    }
}

$conn = null;
echo "<script>window.location.href = 'thank_rent.php';</script>";
?>