<?php
include_once("./connection.php");

// Create a new instance of the connection class
$db = new connection();
$conn = $db->getConnection();

// ...
// Get the selected category or sub-category from the post data
$selectedCategory = isset($_POST['category']) ? $_POST['category'] : null;
$selectedSubCategory = isset($_POST['sub_category']) ? $_POST['sub_category'] : null;

// Modify the SQL query based on the selected category or sub-category
$sql = "SELECT productName, price, images FROM clothing_items WHERE ";

if ($selectedSubCategory) {
    $sql .= "sub_category = :sub_category";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sub_category', $selectedSubCategory);
} elseif ($selectedCategory) {
    $sql .= "category = :category";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category', $selectedCategory);
} else {
    // Default query without any filters
    $stmt = $conn->query("SELECT productName, price, images FROM clothing_items");
}

// Execute the query and fetch results
$stmt->execute();
$clothingItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
