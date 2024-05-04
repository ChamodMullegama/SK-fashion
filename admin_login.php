<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/Admin_Styles/admin_login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="./Images/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (1).png" type="image/x-icon">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <span class="bg-animate">
        </span>

        <div class="form-box login">
            <h2>Login</h2>
            <form action="./Includes/adminLogin.php" method="post">
            <div class="aleart">
                    <?php
                    session_start();
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
                <div class="input-box">
                    <input type="text" name="username" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label>Password</label>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn" name="submit">Login</button>
            </form>
        </div>

        <div class="info-text login">
            <div class="logo">
                <img src="./images/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" alt="">
            </div>
        
            <h2>Welcome Back!</h2>
            <p>Shashini Kaushalya</p>
        </div>
    </div>
</body>
</html>