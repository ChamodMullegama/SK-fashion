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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Homemade+Apple&family=Saira+Extra+Condensed:wght@100&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Styles/SignUp&SignIn.css">
</head>

<body>
    <div id="navBarHome">
        <?php include './header_HOME.php'; ?>
    </div>

    <div id="mobileNav">
        <?php include './header_HOME_M.php'; ?>
    </div>

    <div class="cross">
        <a href="./index.php"><i class="fa-solid fa-xmark"></i></a>
    </div>
    
    <div>
        <form action="./Includes/signUpPage.php" method="POST">
            <div class="box_view_1">
                <h1>Sign Up</h1>
                <div class="aleart">
                    <?php
                   
                    if (isset($_SESSION['erro'])) {
                        echo '<div class="login-status-message-error">' . $_SESSION['erro'] . '</div>';
                        unset($_SESSION['erro']);
                    }
                    if (isset($_SESSION['susess'])) {
                        echo '<div class="login-status-message-success">' . $_SESSION['susess'] . '</div>';
                        unset($_SESSION['susess']);
                    }
                    ?>
                </div>

                <label for="username"><b>Username :</b></label>
                <input type="text" placeholder="Enter Username" name="customer_name" required>

                <label for="email"><b>Email :</b></label>
                <input type="email" placeholder="Enter Email" name="customer_email" required>

                <label for="password"><b>Password :</b></label>
                <input type="password" placeholder="Enter Password" name="customer_password" required>

                <p class="terms">By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                <button class="btn_log_reg" type="submit" class="signupbtn" name="submit">Sign Up</button>
            </div>
            <div class="box_view_2" style="margin-bottom: 12vh;">
                <p class="have">Already have an account? <a href="./loginPage.php" style="color: white;">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>

<?php
include_once("./footer.php");
?>