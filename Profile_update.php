<?php
session_start();
require_once "./Includes/connection.php";


if (isset($_POST['submit'])) {
    $connection = new connection();
    $conn = $connection->getConnection();

    $customer_id = $_SESSION['customer_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2 = $_POST['addressLine2'];
    $town = $_POST['town'];
    $postalCode = $_POST['postalCode'];
    $phoneNumber = $_POST['phoneNumber'];
    $Profile_image = $_FILES['Profile_image']['name'];
    $Profile_image_tmp_name = $_FILES['Profile_image']['tmp_name'];
    $Profile_image_folder = './uploaded_img/profile_pic/'.$Profile_image;
    move_uploaded_file($Profile_image_tmp_name, $Profile_image_folder);
    // You may want to add validation and sanitation here

    // Update user details in the database
    $sql = "UPDATE customer SET
            firstname = :firstName,
            lastName = :lastName,
            Profile_image = :Profile_image,
            addressLine1 = :addressLine1,
            addressLine2 = :addressLine2,
            town = :town,
            postalCode = :postalCode,
            phoneNumber = :phoneNumber
            WHERE customer_id = :customer_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':addressLine1', $addressLine1);
    $stmt->bindParam(':addressLine2', $addressLine2);
    $stmt->bindParam(':town', $town);
    $stmt->bindParam(':postalCode', $postalCode);
    $stmt->bindParam(':phoneNumber', $phoneNumber);
    $stmt->bindParam(':Profile_image', $Profile_image_folder);
    $stmt->bindParam(':customer_id', $customer_id);

    if ($stmt->execute()) {
        // Successfully updated
        header("Location:./Profile.php"); // Redirect to the profile page
        exit();
    } else {
        // Handle the error
        echo "Error updating user details";
    }
} else {
    // Redirect to the profile page if the form was not submitted
    header("Location: profile.php");
    exit();
}
?>