<!-- update_form.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Clothing Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        form {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: hsl(219, 18%, 15%);;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 120px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select,
        textarea {
            width: calc(100% - 16px);
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            background: hsl(219, 17%, 24%);
            color: white;
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

        div.checkbox-group {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
        }

        div.checkbox-group label {
            margin-right: 20px;
        }
    </style>
</head>

<body>

    <?php
        include "./header.php";
    ?>

    <?php
    include './includes/connection.php';

    // Create a new instance of the connection class
    $db = new connection();
    $conn = $db->getConnection();

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['item_id'])) {
        $itemId = $_GET['item_id'];

        // Retrieve the details of the selected item
        $stmt = $conn->prepare("SELECT * FROM clothing_items WHERE id = ?");
        $stmt->execute([$itemId]);
        $itemDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($itemDetails) {
            // Display the update form with pre-filled values
    ?>

            <form action="process_update.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="item_id" value="<?= $itemDetails['id'] ?>">

                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" value="<?= $itemDetails['productName'] ?>" required>

                <label for="category">Category/Type:</label>
                <select id="category" name="category" required>
                    <?php
                    // Assuming $conn is your database connection object
                    $stmt_categories = $conn->prepare("SELECT category_name FROM category");
                    $stmt_categories->execute();
                    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($categories as $category) {
                        $selected = ($itemDetails['category'] == $category['category_name']) ? 'selected' : '';
                        echo '<option value="' . $category['category_name'] . '" ' . $selected . '>' . $category['category_name'] . '</option>';
                    }
                    ?>
                </select>


                <label for="category">Sub Category/Type:</label>
                <select id="sub_category" name="sub_category" required>
                    <?php
                    // Assuming $conn is your database connection object
                    $stmt_subcategories = $conn->prepare("SELECT sub_category_name FROM category");
                    $stmt_subcategories->execute();
                    $subcategories = $stmt_subcategories->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($subcategories as $subcategory) {
                        $selected = ($itemDetails['sub_category'] == $subcategory['sub_category_name']) ? 'selected' : '';
                        echo '<option value="' . $subcategory['sub_category_name'] . '" ' . $selected . '>' . $subcategory['sub_category_name'] . '</option>';
                    }
                    ?>
                </select>

                <label for="brand">Brand:</label>
                <input type="text" id="brand" name="brand" value="<?= $itemDetails['brand'] ?>">

                <label>Size Options:</label>
                <div class="checkbox-group">
                    <?php
                    $sizes = ['S', 'M', 'L', 'XL', 'XXL'];

                    foreach ($sizes as $size) {
                        $isChecked = in_array($size, explode(', ', $itemDetails['sizeOptions']));
                    ?>
                        <input type="checkbox" id="size<?= $size ?>" name="sizeOptions[]" value="<?= $size ?>" <?= ($isChecked) ? 'checked' : '' ?>>
                        <label for="size<?= $size ?>"><?= $size ?></label>
                    <?php
                    }
                    ?>
                </div>

                <label for="material">Material/Fabric:</label>
                <input type="text" id="material" name="material" value="<?= $itemDetails['material'] ?>" required>

                <label for="price">Price:</label>
                <input type="number" id="price" name="price" value="<?= $itemDetails['price'] ?>" min="0" step="0.01" required>

                <label for="quantityAvailable">Quantity Available:</label>
                <input type="number" id="quantityAvailable" name="quantityAvailable" value="<?= $itemDetails['quantityAvailable'] ?>" min="0" required>

                <label for="images">Images:</label>
                <input type="file" id="images" name="images[]" accept="image/*" multiple >

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required><?= $itemDetails['description'] ?></textarea>

                <label for="careInstructions">Care Instructions:</label>
                <textarea id="careInstructions" name="careInstructions" rows="4"><?= $itemDetails['careInstructions'] ?></textarea>

                <label for="tags">Tags/Keywords:</label>
                <input type="text" id="tags" name="tags" value="<?= $itemDetails['tags'] ?>">

                <label for="availabilityStatus">Availability Status:</label>
                <select id="availabilityStatus" name="availabilityStatus" required>
                    <option value="available" <?= ($itemDetails['availabilityStatus'] == 'available') ? 'selected' : '' ?>>Available</option>
                    <option value="preorder" <?= ($itemDetails['availabilityStatus'] == 'preorder') ? 'selected' : '' ?>>Pre-order</option>
                    <option value="outofstock" <?= ($itemDetails['availabilityStatus'] == 'outofstock') ? 'selected' : '' ?>>Out of Stock</option>
                </select>

                <label for="discounts">Discounts/Promotions:</label>
                <input type="text" id="discounts" name="discounts" value="<?= $itemDetails['discounts'] ?>">

                <button type="submit" name="submit">Update Clothing Item</button>
            </form>


    <?php
        } else {
            echo "Item not found!";
        }
    } else {
        echo "Invalid request!";
    }
    ?>

</body>

</html>