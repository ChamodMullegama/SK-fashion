<?php
include './Includes/connection.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
  <title>SK Fashion Hub</title>
  <link rel="stylesheet" href="./Styles/CPassword.css">
</head>
<body>
  <div class="login-box">
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
      <h2>Forgot Password</h2>
      <form action="./Includes/changePassword.php" method="post">
        <div class="box_view_1">
          <h1>Reset password</h1>
          <div class="textbox">
            <input type="password" placeholder="Enter new password" name="customer_new_password" required>
          </div>
          <div class="textbox">
            <input type="password" placeholder="Comform password" name="comfrom_customer_new_password" required>
          </div>
          <input type="submit" class="btn" value="Change password" name="submit">
          <a href="./loginPage.php" class="regtation">Login</a>
        </div>
      </form>     
  </div>
</body>
</html>
