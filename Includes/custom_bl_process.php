<?php
// Assuming you've included the necessary connection.php file here
include_once "./connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id'])) {
    $itemId = $_POST['item_id'];
    // Initialize connection
    $db = new Connection();
    $conn = $db->getConnection();

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO measurements_bl (item_id, shoulder, front_w, back_w, bust_point_w, bust_l, bra_cut_l, upper_bust, bust, bra_cut_waist, waist, waist_jacket_length, armhole, sofa, sl_l, sl_open, neck_depth, saree_jacket_open_side) VALUES (:item_id, :shoulder, :front_w, :back_w, :bust_point_w, :bust_l, :bra_cut_l, :upper_bust, :bust, :bra_cut_waist, :waist, :waist_jacket_length, :armhole, :sofa, :sl_l, :sl_open, :neck_depth, :saree_jacket_open_side)";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':item_id', $_POST['item_id']);
    $stmt->bindParam(':shoulder', $_POST['shoulder']);
    $stmt->bindParam(':front_w', $_POST['front_w']);
    $stmt->bindParam(':back_w', $_POST['back_w']);
    $stmt->bindParam(':bust_point_w', $_POST['bust_point_w']);
    $stmt->bindParam(':bust_l', $_POST['bust_l']);
    $stmt->bindParam(':bra_cut_l', $_POST['bra_cut_l']);
    $stmt->bindParam(':upper_bust', $_POST['upper_bust']);
    $stmt->bindParam(':bust', $_POST['bust']);
    $stmt->bindParam(':bra_cut_waist', $_POST['bra_cut_waist']);
    $stmt->bindParam(':waist', $_POST['waist']);
    $stmt->bindParam(':waist_jacket_length', $_POST['waist_jacket_length']);
    $stmt->bindParam(':armhole', $_POST['armhole']);
    $stmt->bindParam(':sofa', $_POST['sofa']);
    $stmt->bindParam(':sl_l', $_POST['sl_l']);
    $stmt->bindParam(':sl_open', $_POST['sl_open']);
    $stmt->bindParam(':neck_depth', $_POST['neck_depth']);
    $stmt->bindParam(':saree_jacket_open_side', $_POST['saree_jacket_open_side']);

    // Execute the query
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
        header("Location: ../ThankYou_Custom.php");
    } else {
        echo "Error inserting data.";
    }
} else {
    echo "Invalid request.";
}
?>