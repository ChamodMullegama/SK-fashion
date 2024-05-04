<?php
    $currentPage = 'NULL';
    session_start(); 
    include_once "./Includes/connection.php";

    $isLoggedIn = isset($_SESSION['customer_id']);
    if (!$isLoggedIn) {
        header("Location:loginPage.php");
        exit; 
    }
    $username = $_SESSION['customer_name'];
    $cartNotEmpty = isset($_SESSION['cart']) && !empty($_SESSION['cart']);
    $totalAmount = 0;

    if ($cartNotEmpty) {
        foreach ($_SESSION['cart'] as $cartItem) {
            $totalAmount += $cartItem['price'] * $cartItem['quantity'];
        }
    }

    $connection = new connection();
    $conn = $connection->getConnection();
    $customer_id = $_SESSION['customer_id'];
    $sql = "SELECT * FROM customer WHERE customer_id = :customer_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $firstName = $user['firstName'];
    $lastName = $user['lastName'];
    $addressLine1 = $user['addressLine1'];
    $addressLine2 = $user['addressLine2'];
    $town = $user['town'];
    $postalCode = $user['postalCode'];
    $email = $user['customer_email'];
    $phoneNumber = $user['phoneNumber'];
    
    $cartNotEmpty = isset($_SESSION['cart']) && !empty($_SESSION['cart']);
    $totalAmount = 0;
    if ($cartNotEmpty) {
        foreach ($_SESSION['cart'] as $cartItem) {
            $totalAmount += $cartItem['price'] * $cartItem['quantity'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <title>Payment - SK Fashion Hub</title>
    <link rel="stylesheet" href="./Styles/payment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="navBarHome">
        <?php include './header_HOME.php'; ?>
    </div>

    <div id="mobileNav">
        <?php include './header_HOME_M.php'; ?>
    </div>

    <div class="row_all">
        <div class="col-75">
            <div class="container_pay">
                <form action="./Includes/checkout.php" method="post">
                    <div class="row_pay">
                        <div class="col-50">
                            <h3>Billing Address</h3>
                            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                            <div class="row_pay">
                                <div class="col-50">
                                    <input type="text" id="fname" name="firstName" placeholder="First Name" value="<?= $firstName ?>">
                                </div>
                                <div class="col-50">
                                    <input type="text" id="lname" name="lastName" placeholder="Last Name" value="<?= $lastName ?>">
                                </div>
                            </div>
                        
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                            <div class="row_pay">
                                <div class="col-50">
                                    <input type="text" id="state" name="addressLine1" placeholder="House number"  value="<?= $addressLine1 ?>">
                                </div>
                                <div class="col-50">
                                    <input type="text" id="zip" name="addressLine2" placeholder="street name,Apartment,suite,unit,ect..."  value="<?= $addressLine2 ?>">
                                </div>
                            </div>
                            <div class="row_pay">
                                <div class="col-50">
                                    <input type="text" id="state" name="town" placeholder="Town/City"  value="<?= $town ?>">
                                </div>
                                <div class="col-50">
                                    <input type="text" id="zip" name="postalCode" placeholder="Postal Code"  value="<?= $postalCode ?>">
                                </div>
                            </div>
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <input class="specials_2" type="text" id="email" name="email" placeholder="john@example.com" value="<?= $email ?>">
                            <label for="phone"><i class="fa fa-phone"></i>  Phone Number </label>
                            <input class="specials_2" type="text" id="phone" name="phoneNumber" placeholder="xxx xxx xxxx" value="<?= $phoneNumber ?>">
                        </div>

                        <div class="col-50">
                            <h3>Payment</h3>
                            <label for="fname">Accepted Cards</label>
                            <div class="icon-container">
                                <i class="fa fa-cc-visa" style="color:navy; font-size: 40px;" ></i>
                                <i class="fa fa-cc-amex" style="color:blue; font-size: 40px;" ></i>
                                <i class="fa fa-cc-mastercard" style="color:red; font-size: 40px;" ></i>
                                <i class="fa fa-cc-discover" style="color:orange; font-size: 40px;" ></i>
                                <i class="fa fa-cc-paypal" style="color: black; font-size: 40px;" ></i>
                            </div>
                            <label for="cname">Name on Card</label>
                            <input class="specials" type="text" id="cname" name="cardname" placeholder="John More Doe">
                            <label for="ccnum">Credit card number</label>
                            <input class="specials" type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                            <label for="expmonth">Exp Month</label>
                                <select class="specials" class="form-select" id="expmonth" name="expmonth">
                                    <option selected disabled>Select Month</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            <div class="row_pay" style="margin-top: 20px;">
                                <div class="col-50">
                                    <label for="expyear">Exp Year</label>
                                    <select class="specials_2" class="form-select" id="expYear" name="expYear">
                                    <option selected disabled>Select Year</option>
                                    <option value="01">2024</option>
                                    <option value="02">2025</option>
                                    <option value="03">2026</option>
                                    <option value="04">2027</option>
                                    <option value="05">2028</option>
                                    <option value="06">2029</option>
                                    <option value="07">2030</option>
                                    <option value="08">2031</option>
                                </select>
                                </div>
                                <div class="col-50">
                                    <label for="cvv">CVV</label>
                                    <input class="specials" type="text" id="cvv" name="cvv" placeholder="352">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="continueCheckout" value="Continue To Checkout" class="btn_check">
                </form>
            </div>
        </div>
        <div class="col-25">
            <div class="container_pay">
                <h3>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart" style="font-size: 20px !important;"></i><b style="color:red; margin-left: 5px;font-size: 20px !important;"><?php echo count($_SESSION['cart']); ?></b></span></h3>
                <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                    <div class="pay_card_items">
                        <img src="<?= $cartItem['images'][0] ?>" alt="Product Image" class="product-image" style="width: 105px; height: 140px; margin-left: 10px; border-radius: 10px;">
                        <div class="cartWiew" >
                            <p class="cartViewName"> <?= $cartItem['productName'] ?></a>
                            <p> <?= $cartItem['price'] ?></p>
                            <p> <?= $cartItem['quantity'] ?></p>
                            <p>Subtotal: Rs.<?= $cartItem['price'] * $cartItem['quantity'] ?>.00</p>
                        </div>
                    </div>    
                <?php endforeach; ?>
                <hr>
                <p style="font-size: 25px !important;">Total <span class="price" style="color:black"><b>Rs.<?php echo number_format($totalAmount, 2); ?></b></span></p>
            </div>
        </div>
    </div>
    
</body>
</html>
<?php include_once("./footer.php"); ?>