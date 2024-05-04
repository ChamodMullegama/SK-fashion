<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <title>SK Fashion Hub</title>
    <link rel="stylesheet" href="./Styles/Deals_div.css">
</head>

<body>
    <div id="items_deals_FH_home">
        <?php
        require_once './Includes/connection.php';

        $database = new connection();
        $conn = $database->getConnection();

        $query = "SELECT * FROM clothing_items WHERE discounts IS NOT NULL";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (is_numeric($row['discounts'])) {
                $discounted_price = $row['price'] - ($row['price'] * ($row['discounts'] / 100));

                echo "<div class='container'>";
                echo "<div class='container_pr'>";
                echo "<div class='product'>";
                $images = explode(', ', $row['images']);
                if (!empty($images)) {
                    echo '<img class="p_image" src="' . $images[0] . '" alt="Image">';
                } else {
                    echo 'No Image';
                }
                echo "<h3 class='name'>{$row['productName']}</h3>
                            <p><strong>Category:</strong> {$row['category']}</p>
                            <p>Original Price: {$row['price']}</p>
                            <p>Discount: {$row['discounts']}%</p>
                            <p class='price'>Discounted Price: {$discounted_price}</p>
                            <form method='get' action='./item_details.php'>
                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                <button type='submit' class='add-to-cart'>VIEW DETAILS</button>
                            </form>
                        </div>";
                echo "</div>";
                echo "</div>";
            } else {
                // Debug information for items without a valid discount
                // echo "<div>";
                // echo "<p>No valid discount available for {$row['productName']}</p>";
                // echo "</div>";
            }
        }
        $conn = null;
        ?>
    </div>
</body>
</html>