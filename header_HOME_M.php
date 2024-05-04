<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <title>SK Fashion Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./Styles/m_nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn_M" onclick="closeNav()">&times;</a>
        <img class="logo_M_nav" src="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (2).png" alt="">
        <form action="./category.php" method="GET">
            <input type="search" id="searchInput" placeholder="Search..." name="query">
        </form>
        <a class="links_M <?php echo ($currentPage == 'home') ? 'active' : ''; ?>" href="./index.php">Home</a>
        <a class="links_M <?php echo ($currentPage == 'deals') ? 'active' : ''; ?>" href="./Deals_FH.php">Deals</a>
        <a class="links_M <?php echo ($currentPage == 'fashion_hub') ? 'active' : ''; ?>" href="#">
            <button id="SK_F_HUB" onclick="redirectToCategoryPage()">SK Fashion Hub</button>
            <i class="fa-solid fa-angle-down" id="dropdown" onclick="toggleCategories()"></i>
        </a>
        <?php
            echo "<div id='categoryContainer' class='category-container_M' style='display: none;'>";
            foreach ($categories as $category) {
                $categoryName = urlencode($category['category_name']);
                echo "<div class='category-tab-mobile'>";
                echo "<a class='links_M_drop' href='./category.php?category={$categoryName}'><i class='fa-solid fa-circle-dot'></i>{$category['category_name']}</a>";
                echo "</div>";
            }
            echo "</div>";
        ?>
        <a class="links_M <?php echo ($currentPage == 'bridal_wear') ? 'active' : ''; ?>" href="./BridalWear.php">SK Bridal Wear</a>
        <a class="links_M <?php echo ($currentPage == 'cart') ? 'active' : ''; ?>" href="./display_cart.php">Cart<i class="fa-brands fa-opencart fa-bounce"></i></a>
        <?php
            if (isset($_SESSION['customer_name'])) {
                echo '<a class="links_M_bottum username" href="./Profile.php">' . $_SESSION["customer_name"] . '<i class="fa-regular fa-id-badge fa-fade"></i></a>';
                echo '<a class="links_M_bottum oder" href="./Order_items.php">Ordered Items</a>';
                echo '<a class="links_M_bottum logout" href="#" onclick="showLogoutConfirmation()"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>';
            } else {
                echo '<a class="links_M_bottum" href="./loginPage.php"><i class="fa-solid fa-user"></i>Login/Register</a>';
            }
        ?>
    </div>

    <div class="top_M">
        <div class="all_top_M">
            <div class="col_01_M">
                <span class="open_menu" style="margin-top: 1vh;" onclick="openNav()"><i class="fa-solid fa-bars"></i>SK CLOTHING</span>
            </div>
            <div class="col_02_M">
                <a href="./index.php">
                    <video width="100%" height="100%" autoplay loop muted>
                        <source src="./VIDEO/TensorPix - Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (1).mp4" type="video/mp4">
                    </video>
                </a>
            </div>
        </div>
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        function redirectToCategoryPage() {
            window.location.href = './category.php';
        }

        function toggleCategories() {
            var categoryContainer = document.getElementById("categoryContainer");
            categoryContainer.style.display = (categoryContainer.style.display === "none" || categoryContainer.style.display === "") ? "block" : "none";
        }
    </script>
</body>
</html> 
