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
$stmt = $conn->prepare("SELECT * FROM clothing_items");
$stmt->execute();

// Set default values for category, subcategory, and item name
$category = '';
$subCategory = '';
$itemName = '';

// Check if the category parameter is set in the URL
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}

// Check if the subcategory parameter is set in the URL
if (isset($_GET['sub_category'])) {
    $subCategory = $_GET['sub_category'];
}

// Check if the item name parameter is set in the URL
if (isset($_GET['itemName'])) {
    $itemName = '%' . $_GET['itemName'] . '%';
}

// Use a prepared statement to prevent SQL injection
if (!empty($category) && !empty($subCategory) && !empty($itemName)) {
    $stmt = $conn->prepare("SELECT * FROM clothing_items 
                            WHERE category = :category 
                            AND sub_category = :subCategory 
                            AND productName LIKE :itemName");
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':subCategory', $subCategory, PDO::PARAM_STR);
    $stmt->bindParam(':itemName', $itemName, PDO::PARAM_STR);
} elseif (!empty($category) && !empty($subCategory)) {
    $stmt = $conn->prepare("SELECT * FROM clothing_items 
                            WHERE category = :category 
                            AND sub_category = :subCategory");
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':subCategory', $subCategory, PDO::PARAM_STR);
} elseif (!empty($category) && !empty($itemName)) {
    $stmt = $conn->prepare("SELECT * FROM clothing_items 
                            WHERE category = :category 
                            AND productName LIKE :itemName");
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':itemName', $itemName, PDO::PARAM_STR);
} elseif (!empty($subCategory) && !empty($itemName)) {
    $stmt = $conn->prepare("SELECT * FROM clothing_items 
                            WHERE sub_category = :subCategory 
                            AND productName LIKE :itemName");
    $stmt->bindParam(':subCategory', $subCategory, PDO::PARAM_STR);
    $stmt->bindParam(':itemName', $itemName, PDO::PARAM_STR);
} elseif (!empty($category)) {
    $stmt = $conn->prepare("SELECT * FROM clothing_items 
                            WHERE category = :category");
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
} elseif (!empty($subCategory)) {
    $stmt = $conn->prepare("SELECT * FROM clothing_items 
                            WHERE sub_category = :subCategory");
    $stmt->bindParam(':subCategory', $subCategory, PDO::PARAM_STR);
} elseif (!empty($itemName)) {
    $stmt = $conn->prepare("SELECT * FROM clothing_items 
                            WHERE productName LIKE :itemName");
    $stmt->bindParam(':itemName', $itemName, PDO::PARAM_STR);
} else {
    // If neither category, subcategory, nor item name is specified, retrieve all data
    $stmt = $conn->prepare("SELECT * FROM clothing_items");
}

$stmt->execute();

// Fetch all rows as an associative array
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Display the table with filtered results -->
     
<h2>Clothing Items</h2>

    <!-- Add this code above the table, below the category filter form -->
    <form action="filtered_items.php" method="get">
        <div class="top-box">
            <label for="category">Filter by Category:</label>
            <select id="category" name="category">
                <option value="" selected disabled>Select Category</option>
                <?php
                // Assuming $conn is your database connection object
                $stmt_categories = $conn->prepare("SELECT category_name FROM category");
                $stmt_categories->execute();
                $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

                foreach ($categories as $category) {
                    echo '<option value="' . $category['category_name'] . '">' . $category['category_name'] . '</option>';
                }
                ?>
            </select>
            <label class="sub-cat" for="sub_category">Sub Category/Type:</label>
            <select id="sub_category" name="sub_category">
                <option value="" selected disabled>Select Sub Category</option>
                <?php
                // Assuming $conn is your database connection object
                $stmt_categories = $conn->prepare("SELECT sub_category_name FROM category");
                $stmt_categories->execute();
                $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

                foreach ($categories as $category) {
                    echo '<option value="' . $category['sub_category_name'] . '">' . $category['sub_category_name'] . '</option>';
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
            <a id="addCategory" href="./add_cat_process.php">Add Category</a>

            <a id="addItem" href="./item_add_fhub.php">Add new item</a>
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
            <th>Sub Category</th>
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
                <td><?= $row['sub_category'] ?></td>
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
                    <!-- Inside the foreach loop where you display items -->
                    <div id="deleteFormContainer">
                        <form id="deleteForm" action="./delete_item.php" method="post">
                            <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="deleteClass" id="btnDelete" name="delete_item">Delete</button>
                        </form>
                    </div>


                   <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            
                            var updateButtons = document.querySelectorAll('.updateClass');
                            updateButtons.forEach(function(button) {
                                button.addEventListener('click', function() {
                                    var itemId = button.getAttribute('data-item-id');
                                    
                                    window.location.href = 'update_form.php?item_id=' + itemId;
                                });
                            });
                        });

                            function showConfirmationModal() {
                                    document.getElementById('confirmationModal').style.display = 'block';
                                }

                                function closeConfirmationModal() {
                                    document.getElementById('confirmationModal').style.display = 'none';
                                }

                                function deleteItem() {
                                    // Add your logic to handle item deletion here
                                    // For example, submit the form or make an AJAX request to delete the item
                                    document.getElementById('deleteForm').submit();
                                }

                     
            

         
                    </script>



                    </form>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>



</section>

    <div id="deleteConfirmationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
                <p>Are you sure you want to delete this item?</p>
            <div class="modal-buttons">
                <button id="confirmDeleteBtn" class="confirm-btn">Delete</button>
                <button id="cancelDeleteBtn" class="cancel-btn">Cancel</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>