<?PHP
  include './Includes/connection.php';
  $db = new connection();
  $conn = $db->getConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Clothing Item</title>
    <link rel="stylesheet" href="./Styles/Admin_Styles/addClothItem.css">
</head>
<body>

    <form action="./process_form.php" method="post" enctype="multipart/form-data">
        <div class="form-conatiner">
            <div class="aleart">
        <?php
        session_start();
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        </div>

            <label for="productName">Product Name:</label> <br>
            <input type="text" id="productName" name="productName" required><br>

            
            <label for="category">Category/Type:</label><br>
            <select id="category" name="category" required><br>
    <?php
        // Assuming $conn is your database connection object
        $stmt_categories = $conn->prepare("SELECT DISTINCT category_name FROM category");
        $stmt_categories->execute();
        $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $category) {
            echo '<option value="' . $category['category_name'] . '">' . $category['category_name'] . '</option>';
        }
    ?>
    </select><br>

        
    <label for="category">Sub Category/Type:</label><br>
    <select id="category" name="sub_category" required><br>
        <?php
        // Assuming $conn is your database connection object
        $stmt_categories = $conn->prepare("SELECT DISTINCT sub_category_name FROM category");
        $stmt_categories->execute();
        $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $category) {
            echo '<option value="' . $category['sub_category_name'] . '">' . $category['sub_category_name'] . '</option>';
        }
        ?>
    </select><br>


            <label for="brand">Brand:</label><br>
            <input type="text" id="brand" name="brand"><br>

            <label>Size Options:</label><br>
            <div class="checkbox-group">
            
                <input type="checkbox" id="sizeS" name="sizeOptions[]" value="S">
                <label for="sizeS">S</label>

                <input type="checkbox" id="sizeM" name="sizeOptions[]" value="M">
                <label for="sizeM">M</label>

                <input type="checkbox" id="sizeL" name="sizeOptions[]" value="L">
                <label for="sizeL">L</label>

                <input type="checkbox" id="sizeXL" name="sizeOptions[]" value="XL">
                <label for="sizeXL">XL</label>

                <input type="checkbox" id="sizeXXL" name="sizeOptions[]" value="XXL">
                <label for="sizeXXL">XXL</label>
            </div>

            <label for="material">Material/Fabric:</label><br>
            <input type="text" id="material" name="material" required><br>

            <label for="price">Price:</label><br>
            <input type="number" id="price" name="price" min="0" step="0.01" required><br>

            <label for="quantityAvailable">Quantity Available:</label><br>
            <input type="number" id="quantityAvailable" name="quantityAvailable" min="0" required><br>

            <label for="images">Images:</label><br>
            <input type="file" id="images" name="images[]" accept="image/*" multiple required><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" required></textarea><br>

            <label for="careInstructions">Care Instructions:</label><br>
            <textarea id="careInstructions" name="careInstructions" rows="4"></textarea><br>

            <label for="tags">Tags/Keywords:</label><br>
            <input type="text" id="tags" name="tags"><br>

            <label for="availabilityStatus">Availability Status:</label><br>
            <select id="availabilityStatus" name="availabilityStatus" required>
                <option value="available">Available</option>
                <option value="preorder">Pre-order</option>
                <option value="outofstock">Out of Stock</option>
            </select><br>

            <label for="discounts">Discounts/Promotions:</label><br>
            <input type="text" id="discounts" name="discounts"><br>

            <button type="submit" name="submit">Add Clothing Item</button><br>
            <script>
                function toggleAllSizes() {
                    var allCheckbox = document.getElementById('sizeAll');
                    var sizeCheckboxes = document.querySelectorAll('[name="sizeOptions[]"]');
                    
                    sizeCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = allCheckbox.checked;
                    });
                }
            </script>
        </div>
    </form>
    <section>
     
</body>
</html>