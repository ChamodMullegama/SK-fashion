<?php
include './Includes/connection.php'
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <title>SK Fashion Hub</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="./Styles/FP.css">
</head>

<body>

  <div class="login-box">
    <h2>Forgot Password</h2>
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
    <form action="./Includes/forgotPassword.php" method="post">
      <input type="email" placeholder="Enter your email" name="customer_email" required>
      <input type="submit" class="btn" value="Get reset link" name="submit">
      <a href="./loginPage.php" class="regtation">login</a>
    </form>
  </div>

</body>

</html>