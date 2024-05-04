<?php
session_start();
include_once("./Includes/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $itemId = $_POST['itemId'];
    $quantity = $_POST['quantityNumber'];
    $size = $_POST['sizeOfItem'];

    // Fetch item details including price and image path from the database
    $db = new Connection();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT price, productName, category, images FROM clothing_items WHERE id = :itemId");
    $stmt->bindParam(':itemId', $itemId);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        // If item not found in the first table, try the second table
        $stmt = $conn->prepare("SELECT price, productName, category, images FROM clothing_items_bridal_wear WHERE id = :itemId");
        $stmt->bindParam(':itemId', $itemId);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($item) {
        $price = $item['price'];
        $imagePath = $item['images']; // Corrected variable name

        // Add item to the cart session variable along with size and image path
        $_SESSION['cart'][] = array(
            'itemId' => $itemId,
            'quantity' => $quantity,
            'size' => $size,
            'price' => $price,
            'productName' => $item['productName'],
            'category' => $item['category'],
            'images' => explode(',', $item['images']) // Store all images in an array
        );

        header('Location: display_cart.php');
        exit;
    } else {
        echo "Item not found.";
    }
}
?>