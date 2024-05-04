<?php
    $currentPage = 'deals';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <title>SK Fashion Hub</title>
    <link rel="stylesheet" href="./Styles/Deals.css">
</head>
<body>
    <div id="navBar">
        <?php include './Deals_header.php'; ?>
    </div>

    <button id="back-to-top-btn" onclick="scrollToTop()"><i class="fa-solid fa-arrow-up fa-bounce"></i></button>
    <div class="container">
        <div class="container_pr">
            <?php
                require_once './Includes/connection.php';

                $database = new connection();
                $conn = $database->getConnection();

                $query = "SELECT * FROM clothing_items WHERE discounts IS NOT NULL";            
                $stmt = $conn->prepare($query);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if (is_numeric($row['discounts'])) {
                        $discounted_price = $row['price'] - ($row['price'] * ($row['discounts']/100));

                        echo "<div class='colum_product'>";
                        echo "<div class='product'>";
                        $images = explode(', ', $row['images']);
                        if (!empty($images)) {
                            echo '<img class="p_image" src="' . $images[0] . '" alt="Image">';
                        } else {
                            echo 'No Image';
                        }
                        echo "<h3 class='name'>{$row['productName']}</h3>
                                <p style='display: none;'><strong>Material:</strong> {$row['material']}</p>
                                <p><strong>Category:</strong> {$row['category']}</p>
                                <p>Original Price: {$row['price']}</p>
                                <p>Discount: {$row['discounts']}%</p>
                                <p class='price'>Discounted Price: {$discounted_price}</p>
                                <form method='get' action='./item_details.php'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' class='add-to-cart'>ADD TO CART</button>
                                </form>
                            </div>";
                        echo "</div>"; //'.colum_product'
                    } else {
                        // Debug information for items without a valid discount
                        // echo "<div>";
                        // echo "<p>No valid discount available for {$row['productName']}</p>";
                        // echo "</div>";
                    }
                }
                $conn = null;
            ?>
        </div> <!--'.container_pr' -->
    </div> <!--'.container'-->

    <div class="banner animated tada">
        <div class=" big-text animated tada">UP TO 25% OFF</div>
        <div class="mid_text">the entire store</div>
    </div>

    <script src="./js/goTotTop.js"></script>
    <?php include_once("./footer.php"); ?>
</body>
</html>
