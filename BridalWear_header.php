<?php
    $currentPage = 'bridal_wear';
?>

<?php
    include_once("./Includes/connection.php");

    $connection = new connection();
    $conn = $connection->getConnection();

    $sql = "SELECT category_name_BW FROM category_bridal_wear GROUP BY category_name_BW";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $selectedCategory = isset($_GET['category']) ? urldecode($_GET['category']) : null;
    $selectedSubCategory = isset($_GET['sub_category']) ? urldecode($_GET['sub_category']) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <title>SK Fashion Hub</title>
    <link rel="stylesheet" href="./Styles/nav_bar_bw.css">
</head>
<body>
    <div id="navBarHome">
        <?php include './header_HOME.php'; ?>
    </div>

    <div id="mobileNav">
        <?php include './header_HOME_M.php'; ?>
    </div>

    <div class="navbar2">
        <div class="dropdown2">
            <button class="dropbtn2">Bridal Wear
            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown2-content2">
                <?php
                    foreach ($categories as $category) {
                        $categoryName = urlencode($category['category_name_BW']);
                        echo "<div class='category-tab'>";
                        echo "<a class='category-link' href='./BridalWear.php?category={$categoryName}'>{$category['category_name_BW']}</a>";
                        echo "</div>";
                    }                    
                ?>
            </div>
        </div>
        <a href="./BW_Rent_Out.php">Rent Out</a>
   
        <div class="dropdown2">
            <button class="dropbtn2">Custom Birdal Wear
            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown2-content2">
              <a href="./custom_osari_bw.php">Osari</a>
              <a href="./custom_bl_bw.php">Jackets</a>
            </div>
        </div>
        
    </div>
</body>
</html>