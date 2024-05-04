<?php
    // Include the database connection file
    include_once("./Includes/connection.php");

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the category name and description from the form
        $newCategoryName = $_POST['new_category_name'];
        $newCategoryDescription = $_POST['new_category_description'];

        // Validate and sanitize the input if needed

        // Create a new connection
        $connection = new connection();
        $conn = $connection->getConnection();

        // Insert the new category into the database
        $sql = "INSERT INTO category_bridal_wear (category_name_BW, description_BW) VALUES (:category_name, :category_description)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_name', $newCategoryName, PDO::PARAM_STR);
        $stmt->bindParam(':category_description', $newCategoryDescription, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            echo "New category added successfully!";
            header('Location: ./view_item_BW.php');
        } else {
            echo "Error adding category: " . $stmt->errorInfo()[2];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Bridal Wear Category</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }

        .your-form-class {
            max-width: 600px;
            margin: 20px auto;
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

        input,textarea{
            background-color: hsl(219, 17%, 24%);
            border: none;
            border-radius: 5px;
            color: white;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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

    <h2>Add New Bridal Wear Category</h2>

    <!-- Form for adding a new category -->
    <form class="your-form-class" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="new_category_name">Category Name:</label>
        <input type="text" name="new_category_name" required>

        <label for="new_category_description">Description:</label>
        <textarea name="new_category_description" rows="4" cols="50"></textarea>

        <input type="submit" name="add_category" value="Submit">
    </form>
</body>
</html>
