<?php
    session_start();

    if (isset($_GET['itemId'])) {
        $itemIdToRemove = $_GET['itemId'];
        foreach ($_SESSION['cart'] as $key => $cartItem) {
            if ($cartItem['itemId'] == $itemIdToRemove) {
                unset($_SESSION['cart'][$key]);
                redirect('display_cart.php');
            }
        }
    }

    if (isset($_GET['ID'])) {
        $IDToRemove = $_GET['ID'];
        foreach ($_SESSION['cartBW'] as $key => $cartItem) {
            if ($cartItem['ID'] == $IDToRemove) {
                unset($_SESSION['cartBW'][$key]);
                redirect('cart_BW_rent.php');
            }
        }
    }

    function redirect($location) {
        header("Location: $location");
        exit;
    }
?>