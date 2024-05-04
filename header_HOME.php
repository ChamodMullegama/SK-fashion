<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <title>SK Fashion Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Homemade+Apple&family=Saira+Extra+Condensed:wght@100&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Styles/nav_bar_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="top">
        <div class="top-part">
            <div class="logo">
                <a href="./index.php">
                    <video width="100%" height="100%" autoplay loop muted>
                        <source src="./VIDEO/TensorPix - Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (1).mp4" type="video/mp4">
                    </video>
                </a>
            </div>
            
            <div class="menu">
                <ul>
                    <li <?php if ($currentPage === 'home') echo 'class="active"'; ?>><a class="special_tabs" href="./index.php">Home</a></li>
                    <li <?php if ($currentPage === 'deals') echo 'class="active"'; ?>><a class="special_tabs" href="./Deals_FH.php">Deals</a></li>
                    <li <?php if ($currentPage === 'fashion_hub') echo 'class="active"'; ?>><a class="special_tabs" href="./category.php">SK Fashion Hub</a></li>
                    <li <?php if ($currentPage === 'bridal_wear') echo 'class="active"'; ?>><a class="special_tabs" href="./BridalWear.php">SK Bridal wear</a></li>
                    <div class="HP_ICONS">
                        <li style="float: right; margin:0; padding: 0; margin-right: 5%">
                            <div class="Log-in-dropdown"> 
                                <a href="./loginPage.php">
                                    <!-- <i class="fa-regular fa-user"></i> -->
                                    <i class="bi bi-person"></i>
                                </a>

                                <div class="dropdown-content">
                                    <?php
                                        session_start();

                                        if (isset($_SESSION['customer_name'])) {
                                            echo '<a href="./Profile.php" >' . $_SESSION["customer_name"] . '</a>';
                                            echo '<a href="./Order_items.php" >Ordered Items</a>';
                                            echo '<a href="#" onclick="showLogoutConfirmation()">Logout</a>';
                                        } else {
                                            echo '<a href="./loginPage.php">Login</a>';
                                            echo '<a href="./signUpPage.php">Register</a>';
                                        }
                                    ?>
                                </div>  
                            </div>
                        </li>
                        
                        <li style="float: right; margin:0; margin-right: 2%;">
                            <div id="CartItems">
                                <a href="./display_cart.php">
                                    <!-- <i class="bi bi-cart3"></i> -->
                                    <i class="bi bi-bag"></i>
                                </a>
                            </div>
                        </li>

                        <li style="float: right; margin:0; margin-right: 2%;">
                            <div class="search-dropdown" id="searchDropdown">
                                <a href="#" onclick="toggleSearch()">
                                    <i class="bi bi-search"></i>
                                </a>
                                <div class="search-content" id="searchContent">
                                    <form action="./category.php" method="GET">
                                        <input type="text" placeholder="Search for clothing items..." name="query" />
                                    </form>
                                </div>
                            </div>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/nav.js"></script>
</body>
</html>