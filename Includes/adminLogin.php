<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'connection.php';
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $database = new connection();
        $db = $database->getConnection();
        
        $query = "SELECT * FROM admin WHERE admin_username = :username AND admin_password = :password";
        $stmt = $db->prepare($query);
        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            $_SESSION['admin_username'] = $username;
            $_SESSION['success'] = "Login successful!";
            header("Location: ../admin_home.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password!";
            header("Location: ../admin_login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Username and password are required!";
        header("Location: ../admin_login.php");
        exit();
    }
} else {
    header("Location: ../admin_login.php");
    exit();
}
?>