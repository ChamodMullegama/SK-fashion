<?php
require '../Includes/connection.php';
session_start();

if (isset($_SESSION['customer_otp']) && isset($_POST['submit'])) {
    $customer_otp = $_POST['customer_otp'];
    $stored_otp = $_SESSION['customer_otp'];

    if ($customer_otp == $stored_otp) {
        $database = new connection(); 
        try {
            $conn = $database->getConnection();

            $update_sql = 'UPDATE customer SET customer_vstatus = "1" WHERE customer_otp = :customer_otp';
            $stmt = $conn->prepare($update_sql);
            $stmt->bindParam(':customer_otp', $stored_otp);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['success'] = 'Your account is verified. Please login.';
                header('location: ../loginPage.php');
                exit();
            } else {
                $_SESSION['error'] = 'Failed to update v_status for the user.';
                header('location: verify_otp.php');
                exit();
            }
        } catch(PDOException $e) {
            $_SESSION['error'] = 'Oops, something went wrong: ' . $e->getMessage();
            header('location: login.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Invalid OTP. Please try again.';
        header('location: ../verifyUser.php');
        exit();
    }
} else {
    $_SESSION['statuss'] = 'Session expired or invalid request.';
    header('location: login.php');
    exit();
}
?>

