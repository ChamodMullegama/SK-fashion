<?php
session_start();
require '../Includes/connection.php';

if (isset($_POST['submit'])) {
    $customer_new_password = $_POST['customer_new_password'];
    $confirm_password = $_POST['comfrom_customer_new_password'];
    $token = $_GET['token'];
    
    if (
        isset($_SESSION['reset_token']) &&
        $_SESSION['reset_token'] === $token &&
        isset($_SESSION['reset_email'])
    ) {
        $_SESSION['error'] = 'Invalid or expired token';
        header('location:../forgotPassword.php');
        exit();
    }

    if ($customer_new_password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match';
        header('location: ..changePassword.php');
        exit();
    }
    $customer_email = $_SESSION['reset_email'];

    $database = new connection(); 

    try {
        $conn = $database->getConnection();
        $new_password_hash = password_hash($customer_new_password, PASSWORD_DEFAULT);

        $update_sql = 'UPDATE customer SET customer_password = :customer_new_password WHERE customer_email = :customer_email';
        $stmt = $conn->prepare($update_sql);
        $stmt->bindParam(':customer_new_password', $new_password_hash);
        $stmt->bindParam(':customer_email', $customer_email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = 'Password updated successfully. Please log in with your new password.';
            header('location: ../loginPage.php');
            exit();
        } else {
            $_SESSION['error'] = 'Failed to update password';
            header('location: ../forgotPassword.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Oops, something went wrong: ' . $e->getMessage();
        header('location: ../forgotPassword.php');
        exit();
    }
}
?>
