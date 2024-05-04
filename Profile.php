<?php
    $currentPage = 'NULL';
?>

<?php
require_once "./Includes/connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/profile.css">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <style>
    .rounded {
        border-radius: 50%;
    }
</style>

    <title>SK Fashion Hub</title>

</head>
<body>
    <div id="navBarHome">
        <?php include './header_HOME.php'; ?>
    </div>

    <div id="mobileNav">
        <?php include './header_HOME_M.php'; ?>
    </div>

    <div class="container-xl px-4 mt-4 " id="Profile">
      <!-- Account page navigation-->

      <hr class="mt-0 mb-4" />
      <div class="row" id="row">
        <div class="col-xl-4">
          <!-- Profile picture card-->
          <div class="card mb-4 mb-xl-0" id="card">
            <div class="card-header">Profile Picture</div>
            <div class="card-body text-center">
              <!-- Profile picture image-->
           
              <!-- Profile picture help block-->
              <div class="small font-italic text-muted mb-4">
              </div>
              <!-- Profile picture upload button-->

            </div>
            <?php
                // Add any additional include or require statements here

                // Check if the user is logged in
                if (isset($_SESSION['customer_name'])) {
                    // Display user information
             
                    // Fetch additional details from the database
                    $connection = new connection();
                    $conn = $connection->getConnection();

                    $customer_id = $_SESSION['customer_id'];
                    $sql = "SELECT * FROM customer WHERE customer_id = :customer_id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':customer_id', $customer_id);

                    if ($stmt->execute()) {
                        $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Display additional user details
                        echo '<div class="card-body text-center">';
                              $images = explode(', ', $userDetails['Profile_image']);
                              if (!empty($userDetails['Profile_image'])) {
                                echo '<img class="img-account-profile rounded-circle mb-2" style="height:250px; width: 250px;" src="' . $userDetails['Profile_image'] . '">';
                              } else {
                                echo '<img class="img-account-profile rounded-circle mb-2"   style="height: 250px; width: 250px;" src="./IMAGES/user/9334399.jpg">';
                              }
                        echo '</div>';

                        echo '<p>User ID: ' . $_SESSION["customer_id"] . '</p>';
                        echo '<p>User Name: ' . $_SESSION["customer_name"] . '</p>';
                        echo '<p>Email: ' . $_SESSION["customer_email"] . '</p>';
                        echo '<p>First Name: ' . $userDetails["firstName"] . '</p>';
                        echo '<p>Last Name: ' . $userDetails["lastName"] . '</p>';
                        echo '<p>Address Line 1: ' . $userDetails["addressLine1"] . '</p>';
                        echo '<p>Address Line 2: ' . $userDetails["addressLine2"] . '</p>';
                        echo '<p>Town: ' . $userDetails["town"] . '</p>';
                        echo '<p>Postal Code: ' . $userDetails["postalCode"] . '</p>';
                        echo '<p>Phone Number: ' . $userDetails["phoneNumber"] . '</p>';
                        
                    
                        
                    } else {
                        // Handle the error
                        echo "Error fetching user details from the database";
                    }
                } else {
                    // Redirect to the login page if the user is not logged in
                    header("Location: login.php");
                    exit();
                }
            ?>
            <!-- Add this hidden input field inside your form -->
            </div>
        </div>
        <div class="col-xl-8">
          <!-- Account details card-->
          <div class="card mb-4" id="row2">
            <div class="card-header">Account Details</div>
            <div class="card-body">
              <form action="./Profile_update.php" method="post" enctype="multipart/form-data">
                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                  <!-- Form Group (first name)-->
                  <div class="col-md-6">
                    <label class="small mb-1" for="inputFirstName"
                      >First name</label
                    >
                    <input
                      class="form-control"
                      id="inputFirstName"
                      type="text"
                      name="firstName"
                      placeholder="Enter your first name"
                      value=""
                    />
                  </div>
                  <!-- Form Group (last name)-->
                  <div class="col-md-6">
                    <label class="small mb-1" for="inputLastName"
                      >Last name</label
                    >
                    <input
                      class="form-control"
                      id="inputLastName"
                      type="text"
                      name="lastName"
                      placeholder="Enter your last name"
                      value=""
                    />
                  </div>
                  <div class="col-md-12">
                  <label class="small mb-1" for="inputLastName"
                      >profile picture</label
                    >
        <input   class="form-control" type="file" id="Profile_image" name="Profile_image" accept="image/*" multiple required>

                  </div>
                </div>
                <!-- Form Row        -->
                <div class="row gx-3 mb-3">
                  <!-- Form Group (organization name)-->
                  <div class="col-md-6">
                    <label class="small mb-1" for="inputOrgName"
                      >Address </label
                    >
                    <input
                      class="form-control"
                      id="inputOrgName"
                      type="text"
                      name="addressLine1"
                      placeholder="House number"
                      value=""
                    />
                  </div>
                  <!-- Form Group (location)-->
                  <div class="col-md-6">
                    <label class="small mb-1" for="inputLocation"
                      > </label
                    >
                    <input
                      class="form-control"
                      id="inputLocation"
                      type="text"
                      name="addressLine2"
                      placeholder="street name,Apartment,suite,unit,ect... "
                      value=""
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="small mb-1" for="inputLocation"
                      > </label
                    >
                    <input
                      class="form-control"
                      id="inputLocation"
                      type="text"
                      name="town"
                      placeholder="Town/City "
                      value=""
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="small mb-1" for="inputLocation"
                      > </label
                    >
                    <input
                      class="form-control"
                      id="inputLocation"
                      type="text"
                      name="postalCode"
                      placeholder="Postal Code "
                      value=""
                    />
                  </div>
                </div>

                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                  <!-- Form Group (phone number)-->
                  <div class="col-md-6">
                    <label class="small mb-1" for="inputPhone"
                      >Phone number</label
                    >
                    <input
                        class="form-control"
                        id="inputPhone"
                        type="tel"
                        name="phoneNumber"
                        placeholder="Enter your phone number"
                        pattern="0\d{9}"
                        title="Please enter a valid phone number starting with 0 and containing 10 digits"
                        required
                      />
                  </div>
                  <!-- Form Group (birthday)-->
                  <div class="col-md-6">
                    <label class="small mb-1" for="inputBirthday"
                      >Birthday</label
                    >
                    <input
                      class="form-control"
                      id="inputBirthday"
                      type="date"
                      name="birthday"
                      placeholder="Enter your birthday"
                      value=""
                    />
                  </div>
                </div>
                <!-- Save changes button-->
                <button class="btn btn-primary" type="submit" name="submit">
                  Save changes
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>