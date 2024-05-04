<?php 
    session_start();
    include_once("./connection.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $itemId = $_POST['ID'];
        $quantity = $_POST['quantityNumber'];
        $size = $_POST['sizeOfItem'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        $db = new Connection();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT price, cloth_name AS productName, category, image_path AS images FROM rented_clothes WHERE id = :ID");
        $stmt->bindParam(':ID', $itemId);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$item) {
            $stmt = $conn->prepare("SELECT price, productName, category, images FROM clothing_items_bridal_wear WHERE id = :ID");
            $stmt->bindParam(':ID', $itemId);
            $stmt->execute();
            $item = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if ($item) {
            $_SESSION['cartBW'][] = array( 
                'ID' => $itemId,
                'quantity' => $quantity,
                'size' => $size,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'price' => $item['price'],
                'productName' => $item['productName'],
                'category' => $item['category'],
                'images' => explode(',', $item['images'])
            );

            header('Location: ../cart_BW_rent.php');
            exit;
        } else {
            echo "Item not found.";
        }
    }
?>