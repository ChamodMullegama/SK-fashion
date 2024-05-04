<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <title>SK Fashion Hub</title>
    <link rel="stylesheet" href="./Styles/otp.css">
</head>

<body>
    <div>
        <form action="./Includes/verifyUser.php" method="POST">
            <div class="box_view_1">
                <h1>User Verification</h1>
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
                <input type="text" placeholder="Enter OTP" name="customer_otp" required>
                <button name="submit" type="submit">Verify</button>
            </div>
        </form>
    </div>
</body>

</html>