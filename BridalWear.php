<?php
    $currentPage = 'bridal_wear';
    include_once("./BridalWear_header.php");
    include_once("./Includes/connection.php");
    
    $connection = new connection(); // Assuming connection class exists
    $conn = $connection->getConnection();
    echo '<script>document.querySelector("form").action = "./BridalWear.php";</script>';
    $searchQuery = isset($_GET['query']) ? $_GET['query'] : null;
    if ($searchQuery) {
        $sql = "SELECT id, productName, price, images FROM clothing_items_bridal_wear WHERE productName LIKE :searchQuery";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':searchQuery', "%$searchQuery%", PDO::PARAM_STR);
        $stmt->execute();
        $bridalWears = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Display the search results
    } else {
        $selectedCategory = isset($_GET['category']) ? urldecode($_GET['category']) : null;
        if ($selectedCategory) {
            // Retrieve items based on the selected category
            $sql = "SELECT * FROM clothing_items_bridal_wear WHERE category = :category";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':category', $selectedCategory);
            $stmt->execute();
            $bridalWears = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Display the items
        } else {
            // If no category is selected, you can display a message or handle it accordingly
            $sql = "SELECT * FROM clothing_items_bridal_wear ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $bridalWears = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Display all items
        }
    }
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
    <title>SK Fashion Hub</title>
    <link rel="stylesheet" href="./Styles/bridalWear.css">
</head>
<body>
    <div class="main_con">
        <div class="container01">
            <div class="panel">
                <img src="./IMAGES/Shoots/photo_25_2024-01-21_00-16-25.jpg" alt="">
                <div class="text-layer">
                    <h2>Discover Your Dream Bridal Attire</h2>
                </div>
            </div>

            <div class="panel">
                <img src="./IMAGES/Shoots/photo_24_2024-01-21_00-16-25.jpg" alt="">
                <div class="text-layer">
                    <h2>Elegance Redefined: Your Perfect Bridal Look</h2>
                </div>
            </div>

            <div class="panel">
                <img src="./IMAGES/Shoots/photo_45_2024-01-21_00-16-25.jpg" alt="">
                <div class="text-layer">
                    <h2>Captivating Bridal Couture for Your Special Day</h2>
                </div>
            </div>

            <div class="panel active">
                <img src="./IMAGES/Shoots/photo_59_2024-01-21_00-16-25.jpg" alt="">
                <div class="text-layer">
                    <h2>Embrace Timeless Elegance with SK Bridal Wear</h2>
                </div>
            </div>

            <div class="panel">
                <img src="./IMAGES/Shoots/photo_43_2024-01-21_00-16-25.jpg" alt="">
                <div class="text-layer">
                    <h2>Chic and Sophisticated Bridal Fashion Statements</h2>
                </div>
            </div>

            <div class="panel">
                <img src="./IMAGES/Shoots/photo_37_2024-01-21_00-16-25.jpg" alt="">
                <div class="text-layer">
                    <h2>Unveil Your Radiance: SK Bridal Collection</h2>
                </div>
            </div>

            <div class="panel">
                <img src="./IMAGES/Shoots/photo_27_2024-01-21_00-16-25.jpg" alt="">
                <div class="text-layer">
                    <h2>Celebrate Love in Style with SK Bridal Attire</h2>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <button id="back-to-top-btn" onclick="scrollToTop()"><i class="fa-solid fa-arrow-up fa-bounce"></i></button>

    <div class="container">
        <div class="selected-categories">
            <?php  
                if ($selectedCategory) {
                    echo "<div class='selected-categories'>";
                    echo "<span>{$selectedCategory}</span>";
                    echo "</div>";
                }
            ?>
        </div>

        <div class="row_products">
            <?php foreach ($bridalWears as $bridalWear): ?>
                <div class="colum_product">
                    <div class="product">
                        <?php
                        $images = explode(', ', $bridalWear['images']);
                        if (!empty($images)) {
                            ?>
                            <img class="p_image" src="<?php echo $images[0]; ?>" alt="<?php echo $bridalWear['productName']; ?>">
                            <?php
                        }
                        ?>
                        <h2 class="name"><?php echo $bridalWear['productName']; ?></h2>
                        <p class="price">Rs<?php echo $bridalWear['price']; ?></p>
                        <h3>or 3 x Rs.<?php echo number_format($bridalWear['price'] / 3, 2); ?> with 
                            <a href="https://paykoko.com/"><img style="border-radius: 10px;" src="./IMAGES/logo/WhatsApp Image 2024-02-10 at 07.34.45_6a6b3619.jpg" alt="" height="20px" width="60px"></a><br>
                            <form method="get" action="item_details_bw.php" >
                                <input type="hidden" name="id" value="<?php echo $bridalWear['id']; ?>">
                                <button type="submit" class="add-to-cart">ADD TO CART</button>
                            </form>
                        </h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/BW_home.js"></script>
    
    <div class="banner animated tada">
        <div class=" big-text animated tada">UP TO 10% OFF</div>
        <div class="mid_text">the entire store</div>
        <a href="./Deals_BW.php">Check Out Deals</a>
    </div>

    <?php
        include_once('./footer.php')
    ?>
</body>
</html>