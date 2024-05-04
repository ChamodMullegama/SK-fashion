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
        <form action="./Includes/loginPage.php" method="POST">
            <div class="box_view_1">
                <h1>Log-in</h1>
                <div class="aleart">
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo '<div class="login-status-message-error">' . $_SESSION['error'] . '</div>';
                            unset($_SESSION['error']);
                        }
                        if (isset($_SESSION['success'])) {
                            echo '<div class="login-status-message-success">' . $_SESSION['success'] . '</div>';
                            unset($_SESSION['success']);
                        }
                    ?>
                </div>
                <label for="username"><b>Email :</b></label>
                <input type="email" placeholder="Enter E-mail address" name="customer_email" required>

                <label for="password"><b>Password :</b></label>
                <input type="password" placeholder="Enter Password" name="customer_password" required>
                
                <p class="fogot">Fogot <a href="./forgotPassword.php">Password</a></p>
                <button class="btn_log_reg" name="submit" type="submit">Login</button>
            </div>

            <div class="box_view_2" style="margin-bottom: 22vh;">
                <p class="have">Create new account? <a href="./signUpPage.php" style="color: white;">Create</a></p>
            </div>
        </form>
    </div>
</body>
</html>
<?php
    include_once("./footer.php");
?>