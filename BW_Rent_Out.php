<?php
    $currentPage = 'bridal_wear';
    include_once("./BridalWear_header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Styles/BW_RENT_OUT.css">
</head>
<body>
    <button id="back-to-top-btn" onclick="scrollToTop()"><i class="fa-solid fa-arrow-up fa-bounce"></i></button>
    <?php
        include './includes/connection.php';

        $db = new connection();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM rented_clothes WHERE availability = 1";
        $result = $conn->query($sql);

        if ($result->rowCount() > 0) {
            echo "<h2>Available Clothing for Rent</h2>";
            echo "<div class='container'>";
                echo "<div class='container_rent'>";
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='rent_product'>
                            <img class='p_image' src='{$row['image_path']}' alt='Cloth Image'><br>
                            <h3 class='name'>{$row['cloth_name']}</h3>
                            <p><strong>Material:</strong> {$row['material']}</p>
                            <p><strong>Category:</strong> {$row['category']}</p>
                            <p class='price'><strong class='price'>Rs.</strong> {$row['price']}</p>
                            <form method='get' action='./item_details_rentout.php'>
                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                <button type='submit' class='add-to-cart'>VIEW DETAILS</button>
                            </form>
                        </div>";
                }
                echo "</div>";
            } else {
                echo "No clothing available for rent.";
            }
            echo "</div>";
    ?>
    <script src="./js/goTotTop.js"></script>
    <?php
        include_once('./footer.php');
    ?>
</body>
</html>