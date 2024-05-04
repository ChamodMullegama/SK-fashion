<?php
    // Include database connection file
    require_once './Includes/connection.php';
    
    // Check if the delete button for Fashion Hub review is clicked
    if (isset($_POST['delete_fh_item'])) {
        // Get the review ID to be deleted
        $reviewId = $_POST['review_id']; // Assuming you have a hidden input field with the review ID in the form
        
        // Create a database connection instance
        $db = new connection();
        $conn = $db->getConnection();
        
        // Prepare and execute the SQL query to delete the review
        $query = "DELETE FROM reviews WHERE review_id = :review_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':review_id', $reviewId);
        $stmt->execute();
        
        // Redirect back to the page displaying the reviews after deletion
        header("Location: ./customer_reviews.php");
        exit();
    }
?>
