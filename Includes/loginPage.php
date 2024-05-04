<?php
require '../Includes/connection.php';
session_start();

if (isset($_POST['submit'])) {
    $customer_email = $_POST['customer_email'];
    $customer_password = $_POST['customer_password'];

    $database = new connection(); 

    try {
        $conn = $database->getConnection();

        $login_sql = "SELECT * FROM customer WHERE customer_email = :customer_email LIMIT 1";
        $stmt = $conn->prepare($login_sql);
        $stmt->bindParam(':customer_email', $customer_email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if (password_verify($customer_password, $row['customer_password'])) {
                if ($row['customer_vstatus'] == '1') {
                    $_SESSION['customer_id'] = $row['customer_id'];
                    $_SESSION['customer_name'] = $row['customer_name'];
                    $_SESSION['customer_email'] = $row['customer_email'];
                    header('location: ../index.php');
                    exit();
                } else {
                    $_SESSION['error'] = 'Please verify your account.';
                    header('location: ../loginPage.php');
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Invalid email or password.';
                header('location: ../loginPage.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Invalid email or password.';
            header('location: ../loginPage.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Internal server error.';
        header('location: ../loginPage.php');
        exit();
    }
}
?>
