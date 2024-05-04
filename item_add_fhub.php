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
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        form {
            max-width: 800px;
            margin: auto;
            margin-top: 150px;
            padding: 20px;
            background-color: hsl(219, 18%, 15%);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select, textarea {
            width: calc(100% - 16px);
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            background-color: hsl(219, 17%, 24%);
            color: white;
        }

        div.checkbox-group {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
        }

        div.checkbox-group label {
            margin-right: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
        .update-link,.delete-link {
    display: inline-block;
    padding: 8px 16px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
    margin-left: 25PX;
    margin-top: 20px;
}

.update-link:hover ,
.delete-link:hover{
    background-color: #45a049;
}


   table img {
        max-width: 100px; /* Set the maximum width for the images */
        max-height: 100px; /* Set the maximum height for the images */
    }


    .login-status-message-error {
    color: #ff5555;
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 5px;
    background-color: #ffebee;
    transition: opacity 0.3s ease;
  }
  
  .login-status-message-success {
    font-weight: 300;
    color: #33cc33;
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 5px;
    background-color: #f0fff0;
    transition: opacity 0.3s ease;
  }

    </style>
</head>
<body>

    <?php
    include "./header.php";
    ?>

    <form action="process_form.php" method="post" enctype="multipart/form-data">

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

        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required>

        
        <label for="category">Category/Type:</label>
<select id="category" name="category" required>
<?php
    // Assuming $conn is your database connection object
    $stmt_categories = $conn->prepare("SELECT DISTINCT category_name FROM category");
    $stmt_categories->execute();
    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

    foreach ($categories as $category) {
        echo '<option value="' . $category['category_name'] . '">' . $category['category_name'] . '</option>';
    }
?>
</select>

    
<label for="category">Sub Category/Type:</label>
<select id="category" name="sub_category">
    <?php
    // Assuming $conn is your database connection object
    $stmt_categories = $conn->prepare("SELECT DISTINCT sub_category_name FROM category");
    $stmt_categories->execute();
    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

    foreach ($categories as $category) {
        echo '<option value="' . $category['sub_category_name'] . '">' . $category['sub_category_name'] . '</option>';
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