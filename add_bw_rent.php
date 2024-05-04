<?php
include './Includes/connection.php';

$db = new connection();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clothName = $_POST["cloth_name"];
    $material = $_POST["material"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $imagePath = "./uploads_bw_rent/" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);

    $sizeOptions = isset($_POST["sizeOptions"]) ? $_POST["sizeOptions"] : [];
    $sizesString = implode(", ", $sizeOptions);

    $sql = "INSERT INTO rented_clothes (cloth_name, material, description, image_path, category, price, quantity, sizes_BW) 
            VALUES (:clothName, :material, :description, :imagePath, :category, :price, :quantity, :sizesString)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':clothName', $clothName);
    $stmt->bindParam(':material', $material);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':imagePath', $imagePath);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':sizesString', $sizesString);

    try {
        $stmt->execute();
        echo "Clothing added successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Rented Clothing</title>
</head>
<body>
<style>
         body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        form {
            max-width: 800px;
            margin: auto;
            margin-top: 100px;
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

        form #submit {
            background-color: hsl(120, 60%, 50%);
            width: 20%;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 78%;
        }

        form #submit:hover {
            background-color: hsl(120, 60%, 40%);
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

    <?php
        include './header.php'
    ?>
    <h2>Add Rented Clothing</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="cloth_name">Cloth Name:</label>
        <input type="text" name="cloth_name" required><br>

        <label for="material">Material:</label>
        <input type="text" name="material" required><br>

        <label for="description">Description:</label>
        <textarea name="description" rows="4" required></textarea><br>

        <label for="category">Category:</label>
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

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required><br>

        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*" required><br>

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

        <input id="submit" type="submit" value="Add Clothing">
    </form>
</body>
</html>