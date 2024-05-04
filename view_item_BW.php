<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Styles/Admin_Styles/add_item.css">
    <STyle>
        /* add_item.css */
.item-image {
    max-width: 100px; /* Set your desired maximum width */
    height: auto; /* Maintain aspect ratio */
    border: 1px solid #ddd; /* Add a border for better visibility */
    border-radius: 5px; /* Optional: Add border radius for a rounded appearance */
    /* Add more styles as needed */
}

    </STyle>
</head>

<body> 
    <?php
        include("./header.php");
    ?>
    <div class="main">
    <?php

    include './Includes/connection.php';
    session_start();
    // Create a new instance of the connection class
    $db = new connection();
    $conn = $db->getConnection();
    // Retrieve data from the database
    $stmt = $conn->prepare("SELECT * FROM clothing_items_bridal_wear");
    $stmt->execute();

    // Fetch all rows as an associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>


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
        
            <label class="searchItem" for="itemName">Search by Item Name:</label>
            <input type="text" id="itemName" name="itemName" placeholder="Enter item name">

            <div class="btn-apply-clear">
                <button class="apply-clear" id="applyBtn" type="submit">Apply Filter</button>
                <button class="apply-clear" id="clearBtn" type="button" onclick="clearFilters()">Clear</button>
            </div>
        </div>

        <div class="addBtns">
            <a id="addCategory" href="./add_new_category_BW.php">Add Category</a>
            <a id="addItem" href="./add_item_BW.php">Add new item</a>
            <a id="addCategory" href="./add_bw_rent.php">Add rental cloths</a>
            <a id="addCategory" href="./view_bw_rent.php">view rental cloths</a>
            <a id="addItem" href="./add_Custom_Bridal _Wear.php">Add custom cloths</a>
        </div>
        
        <script>
            function clearFilters() {
                document.getElementById("category").value = "";
                document.getElementById("sub_category").value = "";
                document.getElementById("itemName").value = "";
            }
        </script>
    </form>

        <div class="aleart">
        <?php
    
        if (isset($_SESSION['success'])) {
            echo '<div class="login-status-message-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']); 
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="login-status-message-error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']); 
        }

        ?>
        </div>
    
    <table border="1">
        <tr>
            <th>Product Name</th>
            <th>Category</th>
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

        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?= $row['productName'] ?></td>
                <td><?= $row['category'] ?></td>
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
                     <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            
                            var updateButtons = document.querySelectorAll('.updateClass');
                            updateButtons.forEach(function(button) {
                                button.addEventListener('click', function() {
                                    var itemId = button.getAttribute('data-item-id');
                                    
                                    window.location.href = './update_form_bw.php?item_id=' + itemId;
                                });
                            });
                        });
                    </script>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </section>
</div>
</body>
</html>