<?php
include './Includes/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Your Form Title</title>
    <style>
        /* Add your CSS styles here */

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

    <form action="./addCategory.php" method="post" class="your-form-class">

    <div class="aleart">

<?php
session_start();

if (isset($_SESSION['erro'])) {
  echo '<div class="login-status-message-error">' . $_SESSION['erro'] . '</div>';
  unset($_SESSION['erro']);
}
if (isset($_SESSION['success'])) {
  echo '<div class="login-status-message-success">' . $_SESSION['success'] . '</div>';
  unset($_SESSION['success']);
}
?>

</div>

    
        <label for="category">Category:</label>
        <input type="text" id="	category_name" name="category_name" placeholder="Enter category" require>

        <label for="subcategory">Subcategory:</label>
        <input type="text" id="sub_category_name" name="sub_category_name" placeholder="Enter subcategory">

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" placeholder="Enter description" require></textarea>

        <input type="submit" name="add_category" value="Submit">
    </form>

</body>
</html>