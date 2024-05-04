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

    $imagePath = "./uploads_bw_custom/" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);

    $sql = "INSERT INTO custom_clothes (cloth_name, material, description, image_path, category, price, quantity) 
            VALUES (:clothName, :material, :description, :imagePath, :category, :price, :quantity)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':clothName', $clothName);
    $stmt->bindParam(':material', $material);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':imagePath', $imagePath);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);

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
    <?php
        include("./header.php");
    ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: hsl(219, 17%, 24%);
        }

        form {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: hsl(219, 18%, 15%);;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
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

        div.checkbox-group {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
        }

        div.checkbox-group label {
            margin-right: 20px;
        }
    </style>

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
          <option>Osari</option>        
          <option>blues</option>        
        </select>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required><br>

        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*" required><br>

        <input id="submit" type="submit" value="Add Clothing">
    </form>
</body>
</html>