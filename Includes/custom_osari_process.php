<?php
include_once "./connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id'])) {
    $itemId = $_POST['item_id'];

    // Get the form input data
    $measurements = array(
        'item_id' => $itemId,
        'shoulder' => $_POST['shoulder'],
        'front_w' => $_POST['front_w'],
        'front_l' => $_POST['front_l'],
        'bust_point_w' => $_POST['bust_point_w'],
        'bust_l' => $_POST['bust_l'],
        'bra_cut_l' => $_POST['bra_cut_l'],
        'waist_l' => $_POST['waist_l'],
        'low_waist_l' => $_POST['low_waist_l'],
        'hip_l' => $_POST['hip_l'],
        'low_hip_l' => $_POST['low_hip_l'],
        'knee_l' => $_POST['knee_l'],
        'full_l' => $_POST['full_l'],
        'upper_bust' => $_POST['upper_bust'],
        'bust' => $_POST['bust'],
        'bra_cut_waist' => $_POST['bra_cut_waist'],
        'waist' => $_POST['waist'],
        'low_waist' => $_POST['low_waist'],
        'hip' => $_POST['hip'],
        'low_hip_r' => $_POST['low_hip_r'],
        'knee_r' => $_POST['knee_r'],
        'armhole' => $_POST['armhole'],
        'sofa' => $_POST['sofa'],
        'sl_l' => $_POST['sl_l'],
        'sl_open' => $_POST['sl_open'],
        'neck_depth' => $_POST['neck_depth']
    );

    try {
        // Connect to the database
        $db = new Connection();
        $conn = $db->getConnection();

        // Prepare INSERT statement
        $sql = "INSERT INTO measurements (item_id, shoulder, front_w, front_l, bust_point_w, bust_l, bra_cut_l, waist_l, low_waist_l, hip_l, low_hip_l, knee_l, full_l, upper_bust, bust, bra_cut_waist, waist, low_waist, hip, low_hip_r, knee_r, armhole, sofa, sl_l, sl_open, neck_depth) 
                VALUES (:item_id, :shoulder, :front_w, :front_l, :bust_point_w, :bust_l, :bra_cut_l, :waist_l, :low_waist_l, :hip_l, :low_hip_l, :knee_l, :full_l, :upper_bust, :bust, :bra_cut_waist, :waist, :low_waist, :hip, :low_hip_r, :knee_r, :armhole, :sofa, :sl_l, :sl_open, :neck_depth)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        foreach ($measurements as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        // Execute the query
        $stmt->execute();

        echo "Data inserted successfully.";
        header("Location: ../ThankYou_Custom.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>