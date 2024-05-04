<?php
    session_start();
    include_once "./connection.php";

    if (!isset($_SESSION['customer_id']) || empty($_SESSION['cart'])) {
        header("Location: loginPage.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $requiredFields = ['firstName', 'lastName', 'addressLine1', 'town', 'postalCode', 'email', 'phoneNumber'];
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                header("Location: ./displays_cart.php");
                exit;
            }
        }

        $customerName = $_SESSION['customer_name'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $addressLine1 = $_POST['addressLine1'];
        $addressLine2 = isset($_POST['addressLine2']) ? $_POST['addressLine2'] : '';
        $town = $_POST['town'];
        $postalCode = $_POST['postalCode'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];

        $connection = new connection();
        $conn = $connection->getConnection();

        foreach ($_SESSION['cart'] as $cartItem) {
            $itemName = $cartItem['productName'];
            $size = $cartItem['size'];
            $price = $cartItem['price'];
            $quantity = $cartItem['quantity'];
            $subTotal = $cartItem['price'] * $cartItem['quantity'];

            $sql = "INSERT INTO orders (customer_name, first_name, last_name, address_line1, address_line2, town, postal_code, email, phone_number, item_name, size, price, quantity, subtotal) 
                    VALUES (:customer_name, :first_name, :last_name, :address_line1, :address_line2, :town, :postal_code, :email, :phone_number, :item_name, :size, :price, :quantity, :subtotal)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':customer_name', $customerName);
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':address_line1', $addressLine1);
            $stmt->bindParam(':address_line2', $addressLine2);
            $stmt->bindParam(':town', $town);
            $stmt->bindParam(':postal_code', $postalCode);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone_number', $phoneNumber);
            $stmt->bindParam(':item_name', $itemName);
            $stmt->bindParam(':size', $size);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':subtotal', $subTotal);
            $stmt->execute();
        }

        unset($_SESSION['cart']);

        header("Location: ../thankYouPage.php");
        exit;
    } else {
        header("Location: ../display_cart.php");
        exit;
    }
?>