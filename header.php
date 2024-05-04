<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Images/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (1).png" type="image/x-icon">
    <title>Document</title>
    <link rel="stylesheet" href="./Styles/Admin_Styles/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="header">
        <a href="./admin_home.php" class="logo">SK FASHION</a>

        <nav class="navbar">
            <a href="./admin_home.php" class="active">Home</a>
            <a href="./customer_display.php">Customers</a>
            <a href="./view_item.php">Fashion Hub</a>
            <a href="./view_item_BW.php">Bridal Wear</a>
            <a href="#" onclick="confirmLogout(); return false;"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </nav>
    </div>
    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
            window.location.href = "./Admin_logout.php";
            }
        }
    </script>
</body>
</html>