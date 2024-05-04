<?php
// Include database connection file
require_once "./Includes/connection.php";

// Initialize database connection
$db = new connection();
$conn = $db->getConnection();

// Check if order_id is received through POST
if(isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Prepare and execute update query
    $query_update = "UPDATE orders SET confirm_status = 1 WHERE order_id = :order_id";
    $stmt_update = $conn->prepare($query_update);
    $stmt_update->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $stmt_update->execute();

    // Check if update was successful
    if($stmt_update->rowCount() > 0) {
        // Update successful
        echo json_encode(array("status" => "success", "message" => "Order confirmed successfully."));
    } else {
        // Update failed
        echo json_encode(array("status" => "error", "message" => "Failed to confirm order."));
    }
} else {
    // Order ID not received
    echo json_encode(array("status" => "error", "message" => "Order ID not provided."));
}
?>
