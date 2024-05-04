<?php
// Include the database connection class
include './Includes/connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new instance of the connection class
    $db = new connection();
    $conn = $db->getConnection();

    // Get form data
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $sub_category = $_POST['sub_category'];
    $brand = $_POST['brand'];
    $sizeOptions = implode(', ', $_POST['sizeOptions']); // Convert array to string
    $material = $_POST['material'];
    $price = $_POST['price'];
    $quantityAvailable = $_POST['quantityAvailable'];
    $description = $_POST['description'];
    $careInstructions = $_POST['careInstructions'];
    $tags = $_POST['tags'];
    $availabilityStatus = $_POST['availabilityStatus'];
    $discounts = $_POST['discounts'];

    
    // Upload images
    $targetDirectory = "./uploaded_img/";
    $uploadedImages = array();

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $targetFile = $targetDirectory . basename($_FILES['images']['name'][$key]);
        move_uploaded_file($tmp_name, $targetFile);
        $uploadedImages[] = $targetFile;
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO clothing_items (productName, category,sub_category, brand, sizeOptions, material, price, quantityAvailable, description, careInstructions, tags, availabilityStatus, discounts, images) VALUES (?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([$productName, $category,$sub_category, $brand, $sizeOptions, $material, $price, $quantityAvailable, $description, $careInstructions, $tags, $availabilityStatus, $discounts, implode(', ', $uploadedImages)]);


    $_SESSION['success'] = 'Clothing item added successfully!';
    header('location: ./view_item.php');
    exit();
   

} else {
    echo "Invalid request!";
}
?>
