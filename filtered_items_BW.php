<?php
    include "./header.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Styles/Admin_Styles/add_item.css">
</head>

<body>
<div class="main">
        <?php

        include './includes/connection.php';

        // Create a new instance of the connection class
        $db = new connection();
        $conn = $db->getConnection();
        // Retrieve data from the database
        $stmt = $conn->prepare("SELECT * FROM clothing_items_bridal_wear");
        $stmt->execute();

        // Set default values for category and item name
        $category = '';
        $itemName = '';

        // Check if the category parameter is set in the URL
        if (isset($_GET['category'])) {
            $category = $_GET['category'];
        }

        // Check if the item name parameter is set in the URL
        if (isset($_GET['itemName'])) {
            $itemName = '%' . $_GET['itemName'] . '%';
        }

        // Use a prepared statement to prevent SQL injection
        if (!empty($category) && !empty($itemName)) {
            $stmt = $conn->prepare("SELECT * FROM clothing_items_bridal_wear 
                                    WHERE category = :category 
                                    AND productName LIKE :itemName");
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->bindParam(':itemName', $itemName, PDO::PARAM_STR);
        } elseif (!empty($category)) {
            $stmt = $conn->prepare("SELECT * FROM clothing_items_bridal_wear 
                                    WHERE category = :category");
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        } elseif (!empty($itemName)) {
            $stmt = $conn->prepare("SELECT * FROM clothing_items_bridal_wear 
                                    WHERE productName LIKE :itemName");
            $stmt->bindParam(':itemName', $itemName, PDO::PARAM_STR);
        } else {
            // If neither category nor item name is specified, retrieve all data
            $stmt = $conn->prepare("SELECT * FROM clothing_items_bridal_wear");
        }

        $stmt->execute();

        // Fetch all rows as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <!-- Display the table with filtered results -->

        <h2>Clothing Items</h2>
        <!-- Add this code above the table, below the category filter form -->
        <form action="./filtered_items_BW.php" method="get">
            <div class="top-box">
                <label for="category">Filter by Category:</label>
                <select id="category" name="category">
                    <option value="" selected disabled>Select Category</option>
                    <?php
                    // Assuming $conn is your database connection object
                    $stmt_categories = $conn->prepare("SELECT category_name_BW FROM category_bridal_wear");
                    $stmt_categories->execute();
                    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($categories as $category) {
                        echo '<option value="' . $category['category_name_BW'] . '">' . $category['category_name_BW'] . '</option>';
                    }
                    ?>
                </select>

                <label for="itemName">Search by Item Name:</label>
                <input type="text" id="itemName" name="itemName" placeholder="Enter item name">
                <div class="btn-apply-clear">
                    <button class="apply-clear" id="applyBtn" type="submit">Apply Filter</button>
                    <button class="apply-clear" type="button" id="clearBtn">Clear</button>
                </div>
                
            </div>

            <div class="addBtns">
                <a id="addCategory" href="./add_new_category_BW.php">Add Category</a>

                <a id="addItem" href="./add_item_BW.php">Add new item</a>
            </div>
    
            <script>
        // JavaScript for form submission (Optional)
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const clearBtn = document.getElementById('clearBtn');

            clearBtn.addEventListener('click', function() {
                // Reset all form fields
                form.reset();
                form.submit();
            });
            });
        </script>
        </form>

        <?php
        // Check if there are any results
        if (count($result) > 0) {
            ?>
            <table border="1">
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <!-- Remove the <th> for Sub Category -->
                    <th>Brand</th>
                    <th>Size Options</th>
                    <th>Material</th>
                    <th>Price</th>
                    <th>Quantity Available</th>
                    <th>Description</th>
                    <th>Care Instructions</th>
                    <th>Tags</th>
                    <th>Availability Status</th>
                    <th>Discounts</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?= $row['productName'] ?></td>
                        <td><?= $row['category'] ?></td>
                        <!-- Remove the <td> for Sub Category -->
                        <td><?= $row['brand'] ?></td>
                        <td><?= $row['sizeOptions'] ?></td>
                        <td><?= $row['material'] ?></td>
                        <td><?= $row['price'] ?></td>
                        <td><?= $row['quantityAvailable'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['careInstructions'] ?></td>
                        <td><?= $row['tags'] ?></td>
                        <td><?= $row['availabilityStatus'] ?></td>
                        <td><?= $row['discounts'] ?></td>
                        <td>
                            <?php
                            $images = explode(', ', $row['images']);
                            if (!empty($images)) {
                                echo '<img class="item-image" src="' . $images[0] . '" alt="Image">';
                            } else {
                                echo 'No Image';
                            }
                            ?>
                    </td>


            
                    <td>

                        <button type="button" class="updateClass" id="btnUpdate" data-bs-toggle="modal" data-bs-target="#updateFormModal" data-item-id="<?= $row['id'] ?>">Update</button>
                        <form action="./delete_item_BW.php" method="post">
                            <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="deleteClass" id="btnDelete" name="delete_item">Delete</button>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </table>

            <!-- Your existing filter form -->



            <script>
                document.addEventListener('DOMContentLoaded', function() {
                                // Add click event listener to all update buttons
                                var updateButtons = document.querySelectorAll('.update-btn');
                                updateButtons.forEach(function(button) {
                                    button.addEventListener('click', function() {
                                        var itemId = button.getAttribute('data-item-id');
                                        // Redirect to the update form with the corresponding item ID
                                        window.location.href = 'update_form.php?item_id=' + itemId;
                                    });
                                });
                            });
            </script>

        <?php
        } else {
            // Display a Bootstrap alert when no items are found
            echo '<div class="alert alert-warning" role="alert">No items found.</div>';
        }
        ?>
</div>
    
</body>

</html>