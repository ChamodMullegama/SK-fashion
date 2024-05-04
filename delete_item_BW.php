<?php
include './Includes/connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_item'])) {
    $db = new connection();
    $conn = $db->getConnection();

    $itemId = $_POST['item_id'];

    try {
        // Delete related rows from the reviews table
        $stmt_reviews = $conn->prepare("DELETE FROM reviews_bw WHERE item_id = ?");
        $stmt_reviews->execute([$itemId]);

        // Now you can safely delete the item from the clothing_items table
        $stmt_clothing_items = $conn->prepare("DELETE FROM clothing_items_bridal_wear WHERE id = ?");
        $stmt_clothing_items->execute([$itemId]);

        $_SESSION['success'] = 'Clothing item deleted successfully!';
        header('location: view_item_BW.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error deleting item: ' . $e->getMessage();
        header('location: view_item_BW.php');
        exit();
    }
} else {
    echo "Invalid request!";
}
?>