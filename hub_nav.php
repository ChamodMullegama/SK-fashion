<?php
    include_once("./Includes/connection.php");

    $connection = new connection();
    $conn = $connection->getConnection();

    $sql = "SELECT category_name, GROUP_CONCAT(sub_category_name) AS sub_categories 
            FROM category 
            GROUP BY category_name";
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
    <link rel="stylesheet" href="./Styles/nav_bar_f_hub.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-LX3+WlBAe3+6JRiZboOPlYBevX45T+uAopXeHh18eViukNAT91+lyoFw7jxPY2b48yN6Yzx1eHVm1H01MpI5opA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="navBarHome">
        <?php include './header_HOME.php'; ?>
    </div>

    <div id="mobileNav">
        <?php include './header_HOME_M.php'; ?>
    </div>

    <div class="navbar2">
        <?php
            foreach ($categories as $category) {
                $categoryName = urlencode($category['category_name']);
                echo "<div class='category-tab'>";
                echo "<a class='category-link' href='./category.php?category={$categoryName}'>{$category['category_name']}</a>";

                if (!empty($category['sub_categories'])) {
                    echo "<i class='fa-solid fa-angle-down' style='color: white; margin-right: 20px;'></i>";
                    $subCategories = explode(",", $category['sub_categories']);
                    echo "<div class='category-dropdown'>";
                    foreach ($subCategories as $subCategory) {
                        $subCategoryName = urlencode(trim($subCategory));
                        echo "<a class='sub-category-link' href='./category.php?category={$categoryName}&sub_category={$subCategoryName}'>{$subCategory}</a>";
                    }
                    echo "</div>";
                }

                echo "</div>";
            }
        ?>
    </div>

    <script>
        function filterItems(category, subCategory) {
            event.preventDefault();

            document.getElementById('category').value = category;
            document.getElementById('sub_category').value = subCategory;
            document.getElementById('filterForm').submit();
        }
    </script>
</body>
</html>

<?php
// include_once("./footer.php");
?>