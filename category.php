<?php
    $currentPage = 'fashion_hub';
?>

<?php
    include_once("./hub_nav.php");
    echo '<script>document.querySelector("form").action = "./category.php";</script>';

    $searchQuery = isset($_GET['query']) ? $_GET['query'] : null;
    if ($searchQuery) {
        $sql = "SELECT id, productName, price, images FROM clothing_items WHERE productName LIKE :searchQuery";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':searchQuery', "%$searchQuery%", PDO::PARAM_STR);
    } else {
        // Fetch items based on selected category/subcategory
        $selectedCategory = isset($_GET['category']) ? urldecode($_GET['category']) : null;
        $selectedSubCategory = isset($_GET['sub_category']) ? urldecode($_GET['sub_category']) : null;

        $sql = "SELECT id, productName, price, images FROM clothing_items WHERE ";

        if ($selectedSubCategory) {
            $sql .= "sub_category LIKE :sub_category";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':sub_category', "%$selectedSubCategory%", PDO::PARAM_STR);
        } elseif ($selectedCategory) {
            $sql .= "category = :category";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':category', $selectedCategory);
        } else {
            $stmt = $conn->query("SELECT id, productName, price, images FROM clothing_items");
        }
    }
    
    $stmt->execute();
    $clothingItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <title>SK Fashion Hub</title>
    <link rel="stylesheet" href="./Styles/category.css">
</head>
<body>
    <div class="box_vid_text">
        <!-- <video id="myVideo" width="100%" height="100%" loop muted onended="stopVideo()" autoplay>
            <source src="./VIDEO/woman_picking_out_clothes (720p).mp4" type="video/mp4">
        </video> -->
        <div class="img_txt_ins">
            <div class="div diva">
                <h2>SK FASHION HUB</h2>
            </div>
        </div>
    </div>

    <button id="back-to-top-btn" onclick="scrollToTop()"><i class="fa-solid fa-arrow-up fa-bounce"></i></button>

    <div class="container">
        <div class="selected-categories">
            <?php  
                $displayedCategories = false;
                if ($selectedCategory || $selectedSubCategory) {
                    echo "<div class='selected-categories'>";
                    
                    if ($selectedCategory) {
                        echo "<span>{$selectedCategory}</span>";
                        $displayedCategories = true;
                    }
                    
                    if ($selectedSubCategory) {
                        if ($displayedCategories) {
                            echo "<i class='fa-solid fa-angle-right' style='margin-right: 10px;'></i>";
                        }
                        echo "<span>{$selectedSubCategory}</span>";
                    }
                
                    echo "</div>";
                }
            ?>
        </div>

        <div class="row_products">
            <?php foreach ($clothingItems as $item): ?>
                <div class="colum_product">
                    <div class="product">
                        <?php
                            $images = explode(',', $item['images']);
                            if (!empty($images)) {
                                ?>
                                <img class="p_image" src="<?php echo $images[0]; ?>" alt="<?php echo $item['productName']; ?>">
                                <?php
                            }
                        ?>
                        <h2 class="name"><?php echo $item['productName']; ?></h2>
                        <p class="price">Rs<?php echo $item['price']; ?></p>
                        <h3>or 3 x Rs.<?php echo number_format($item['price'] / 3, 2); ?> with<a href="https://paykoko.com/"><img style="border-radius: 10px;" src="./IMAGES/logo/WhatsApp Image 2024-02-10 at 07.34.45_6a6b3619.jpg" alt="" height="20px" width="60px"></a><br>
                        <form method="get" action="item_details.php" >
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <button type="submit" class="add-to-cart">ADD TO CART</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/goTotTop.js"></script>
    

    <div class="banner animated tada">
        <div class=" big-text animated tada">UP TO 25% OFF</div>
        <div class="mid_text">the entire store</div>
        <a href="./Deals_FH.php">Check Out Deals</a>
    </div>

    <?php
        include_once('./footer.php')
    ?>
</body>
</html>