<?php
// Include database connection
include './includes/connection.php';

// Check if ID is set and is a valid integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
    $id = htmlspecialchars($_GET['id']);

    // Create database connection
    $db = new connection();
    $conn = $db->getConnection();

    // Prepare SQL statement to delete the item
    $sql = "DELETE FROM rented_clothes WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':id', $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the page where deletion was initiated
        header("Location: view_bw_rent.php");
        exit();
    } else {
        echo "Error deleting record";
    }
} else {
    echo "Invalid request";
}
?>