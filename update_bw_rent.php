<?php
include './includes/connection.php';

include "./header.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $cloth_name = $_POST['cloth_name'];
    $material = $_POST['material'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $sizes = $_POST['sizes'];
    
    // Perform update query
    $db = new connection();
    $conn = $db->getConnection();
    $sql = "UPDATE rented_clothes SET 
            cloth_name = :cloth_name, 
            material = :material, 
            description = :description, 
            category = :category, 
            price = :price, 
            quantity = :quantity, 
            sizes_BW = :sizes 
            WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cloth_name', $cloth_name);
    $stmt->bindParam(':material', $material);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':sizes', $sizes);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        header("Location: view_bw_rent.php"); // Redirect back to the main page after update
        exit();
    } else {
        echo "Error updating record";
    }
} else {
    // If the form is not submitted, retrieve the data for the selected item
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        
        // Fetch data for the selected item
        $db = new connection();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM rented_clothes WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
            echo "Record not found";
            exit();
        }
    } else {
        echo "Invalid request";
        exit();
    }
}
?>
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
    <!-- Include any necessary CSS files here -->
</head>
<body>
    <h2>Update Clothing Item</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Cloth Name: <input type="text" name="cloth_name" value="<?php echo $row['cloth_name']; ?>"><br>
        Material: <input type="text" name="material" value="<?php echo $row['material']; ?>"><br>
        Description: <textarea name="description"><?php echo $row['description']; ?></textarea><br>
        Category: <input type="text" name="category" value="<?php echo $row['category']; ?>"><br>
        Price: <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>
        Quantity: <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>"><br>
        Sizes: <input type="text" name="sizes" value="<?php echo $row['sizes_BW']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>