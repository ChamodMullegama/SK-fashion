<?php

require './Includes/connection.php';
session_start();


if (isset($_POST['add_category'])) {
    
    $category_name = $_POST['category_name'];
    $sub_category_name = $_POST['sub_category_name'];
    $description = $_POST['description'];

    $database = new connection(); 

    try {
        $conn = $database->getConnection();

   
        $insert_sql = "INSERT INTO category (category_name,sub_category_name,description) VALUES (:category_name,:sub_category_name,:description)";
        $stmt = $conn->prepare($insert_sql);


        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':sub_category_name', $sub_category_name);
        $stmt->bindParam(':description', $description);

        $stmt->execute();

        $_SESSION['success'] = 'category added sususfully.';
        header('location:./view_item.php');
        exit();
       
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



?>