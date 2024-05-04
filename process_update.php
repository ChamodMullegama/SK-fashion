<?php
include './includes/connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new instance of the connection class
    $db = new connection();
    $conn = $db->getConnection();

    $itemId = $_POST['item_id'];
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $sizeOptions = implode(', ', $_POST['sizeOptions']);
    $material = $_POST['material'];
    $price = $_POST['price'];
    $quantityAvailable = $_POST['quantityAvailable'];
    $description = $_POST['description'];
    $careInstructions = $_POST['careInstructions'];
    $tags = $_POST['tags'];
    $availabilityStatus = $_POST['availabilityStatus'];
    $discounts = $_POST['discounts'];

    // Handle uploaded images only if new images are selected
    if (!empty($_FILES['images']['name'][0])) {
        $targetDirectory = "./uploaded_img/";
        $uploadedImages = array();

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $targetFile = $targetDirectory . basename($_FILES['images']['name'][$key]);
            move_uploaded_file($tmp_name, $targetFile);
            $uploadedImages[] = $targetFile;
        }

        // Update data in the database with new images
        $stmt = $conn->prepare("UPDATE clothing_items SET
            productName = ?,
            category = ?,
            brand = ?,
            sizeOptions = ?,
            material = ?,
            price = ?,
            quantityAvailable = ?,
            description = ?,
            careInstructions = ?,
            tags = ?,
            availabilityStatus = ?,
            discounts = ?,
            images = ?
            WHERE id = ?");

        $stmt->execute([$productName, $category, $brand, $sizeOptions, $material, $price, $quantityAvailable, $description, $careInstructions, $tags, $availabilityStatus, $discounts, implode(', ', $uploadedImages), $itemId]);
    } else {
        // Update data in the database without changing the existing images
        $stmt = $conn->prepare("UPDATE clothing_items SET
            productName = ?,
            category = ?,
            brand = ?,
            sizeOptions = ?,
            material = ?,
            price = ?,
            quantityAvailable = ?,
            description = ?,
            careInstructions = ?,
            tags = ?,
            availabilityStatus = ?,
            discounts = ?
            WHERE id = ?");

        $stmt->execute([$productName, $category, $brand, $sizeOptions, $material, $price, $quantityAvailable, $description, $careInstructions, $tags, $availabilityStatus, $discounts, $itemId]);
    }

    // Redirect back to the admin page after updating
    $_SESSION['success'] = 'Item updated successfully!';
    header('location: view_item.php');
    exit();
} else {
    echo "Invalid request!";
}
?>