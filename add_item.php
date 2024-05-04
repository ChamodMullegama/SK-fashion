<?php
include './includes/connection.php';
$db = new connection();
$conn = $db->getConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Clothing Item</title>
</head>
<body>

<form action="./includes/process_form_BW.php" method="post" enctype="multipart/form-data">

    <div class="alert">
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

    <label for="productName">Product Name:</label>
    <input type="text" id="productName" name="productName" required>

    <label for="category">Category/Type:</label>
    <select id="category" name="category" required>
        <?php
        $stmt_categories = $conn->prepare("SELECT DISTINCT category_name_BW FROM category_bridal_wear");
        $stmt_categories->execute();
        $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $category) {
            echo '<option value="' . $category['category_name_BW'] . '">' . $category['category_name_BW'] . '</option>';
        }
        ?>
    </select>

    <label for="brand">Brand:</label>
    <input type="text" id="brand" name="brand">

    <label>Size Options:</label>
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

    <label for="material">Material/Fabric:</label>
    <input type="text" id="material" name="material" required>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" min="0" step="0.01" required>

    <label for="quantityAvailable">Quantity Available:</label>
    <input type="number" id="quantityAvailable" name="quantityAvailable" min="0" required>

    <label for="images">Images:</label>
    <input type="file" id="images" name="images[]" accept="image/*" multiple required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required></textarea>

    <label for="careInstructions">Care Instructions:</label>
    <textarea id="careInstructions" name="careInstructions" rows="4"></textarea>

    <label for="tags">Tags/Keywords:</label>
    <input type="text" id="tags" name="tags">

    <label for="availabilityStatus">Availability Status:</label>
    <select id="availabilityStatus" name="availabilityStatus" required>
        <option value="available">Available</option>
        <option value="preorder">Pre-order</option>
        <option value="outofstock">Out of Stock</option>
    </select>

    <label for="discounts">Discounts/Promotions:</label>
    <input type="text" id="discounts" name="discounts">

    <button type="submit" name="submit">Add Clothing Item</button>
    <script>
        function toggleAllSizes() {
            var allCheckbox = document.getElementById('sizeAll');
            var sizeCheckboxes = document.querySelectorAll('[name="sizeOptions[]"]');

            sizeCheckboxes.forEach(function(checkbox) {
                checkbox.checked = allCheckbox.checked;
            });
        }
    </script>
</form>

<section>
</body>
</html>
