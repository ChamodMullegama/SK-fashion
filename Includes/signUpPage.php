<?php
    require '../Includes/connection.php';
    include '../Includes/send_mail.php';
    session_start();


    function generateOTP($length = 6)
    {
        return rand(pow(10, $length - 1), pow(10, $length) - 1);
    }

    $customer_otp = generateOTP();
    $_SESSION['customer_otp'] = $customer_otp;


    if (isset($_POST['submit'])) {
        $customer_name = $_POST['customer_name'];
        $customer_email = $_POST['customer_email'];
        $customer_password = $_POST['customer_password'];
        $customer_passhash = password_hash($customer_password, PASSWORD_DEFAULT);
        $customer_otp = generateOTP();
        $_SESSION['customer_otp'] = $customer_otp;

        if (strlen($customer_password) < 5) {
            $_SESSION['erro'] = 'Password should be at least 5 characters long.';
            header("location:../signUpPage.php");
            exit();
        } elseif (!preg_match('/[A-Z]/', $customer_password)) {
            $_SESSION['erro'] = 'Password should include at least one uppercase letter.';
            header("location:../signUpPage.php");
            exit();
        } elseif (!preg_match('/[a-z]/', $customer_password)) {
            $_SESSION['erro'] = 'Password should include at least one lowercase letter.';
            header("location:../signUpPage.php");
            exit();
        } elseif (!preg_match('/[0-9]/', $customer_password)) {
            $_SESSION['erro'] = 'Password should include at least one digit.';
            header("location:../signUpPage.php");
            exit();
        } elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $customer_password)) {
            $_SESSION['erro'] = 'Password should include at least one special character.';
            header("location:../signUpPage.php");
            exit();
        }
        


        $database = new connection(); 

        try {
            $conn = $database->getConnection();


            $sql_check_name = "SELECT customer_name FROM customer WHERE customer_name = :customer_name";
            $stmt_check_name = $conn->prepare($sql_check_name);
            $stmt_check_name->bindParam(':customer_name', $customer_name);
            $stmt_check_name->execute();
            $result_check_name = $stmt_check_name->fetch();

            if ($result_check_name) {
                $_SESSION['erro'] = 'Username name already exists';
                header("location:../signUpPage.php");
                exit();
            }


            $sql = "SELECT customer_email FROM customer WHERE customer_email = :customer_email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':customer_email', $customer_email);
            $stmt->execute();
            $result = $stmt->fetch();


            if ($result) {
                $_SESSION['erro'] = 'email is already exists';
                header("location:../signUpPage.php");
            } else {

                $sql_insert = "INSERT INTO customer (customer_name, customer_email, customer_password, customer_otp) VALUES (:customer_name, :customer_email, :customer_password, :customer_otp)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bindParam(':customer_name', $customer_name);
                $stmt_insert->bindParam(':customer_email', $customer_email);
                $stmt_insert->bindParam(':customer_password', $customer_passhash);
                $stmt_insert->bindParam(':customer_otp', $customer_otp);
                $result_insert = $stmt_insert->execute();

                if ($result_insert) {
                    ob_start();
                    $send_mail = new send_mail();
                    $send_mail->send_mail($customer_name, $customer_email, $customer_otp);
                    ob_end_clean();
                    $_SESSION['success'] = 'Registration successful. Please verify your account with the OTP sent to your email.';
                    header("location: ../verifyUser.php");
                    exit();
                } else {
                    $_SESSION['error'] = 'Registration failed';
                    header("location: ../signUpPage.php");
                    exit();
                }
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
?>