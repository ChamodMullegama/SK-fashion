<?php
    $currentPage = 'NULL';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <title>SK Fashion Hub</title>
    <link rel="stylesheet" href="./Styles/thank.css">
</head>
<body>
    <div id="navBarHome">
        <?php include './header_HOME.php'; ?>
    </div>

    <div id="mobileNav">
        <?php include './header_HOME_M.php'; ?>
    </div>

    <div class="popup" id="popup">
        <h2>Custom Order Saved Successfully!</h2>
        <p>Thank You Yor Shopping.</p>
        <video id="myVideo" width="150px" height="150px" autoplay muted>
            <source src="./VIDEO/Animation - 1710832115995.webm" type="video/webm">
            Your browser does not support the video tag.
        </video>
            
        <div class="button-container">
            <button class="button1" style="margin-left: 10px;" onclick="redirectToHome()">View Oders</button>
        </div>
    </div>

    <script>
        function redirectToHome() {
            window.location.href = "./index.php";
        }
    </script>

    <script>
        function displayPopup() {
            var popup = document.getElementById("popup");
            popup.style.display = "block";
        }

        document.getElementById("continueCheckout").onclick = function() {
            displayPopup();
        };
    </script>
</body>
</html>