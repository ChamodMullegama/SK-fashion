<?php
// Include database connection file
require_once "./Includes/connection.php";

if(isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Initialize database connection
    $db = new connection();
    $conn = $db->getConnection();

    // Prepare and execute deletion query
    $query_delete = "DELETE FROM orders WHERE order_id = :order_id";
    $stmt_delete = $conn->prepare($query_delete);
    $stmt_delete->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $stmt_delete->execute();

    // Check if deletion was successful
    if($stmt_delete->rowCount() > 0) {
        // Deletion successful
        echo json_encode(array("status" => "success", "message" => "Order cancelled successfully."));
    } else {
        // Deletion failed
        echo json_encode(array("status" => "error", "message" => "Failed to cancel order."));
    }
} else {
    // Order ID not received
    echo json_encode(array("status" => "error", "message" => "Order ID not provided."));
}
?>
