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
    <link rel="stylesheet" href="./Styles/cart.css">
</head>
<body>
    <div id="navBar">
        <?php include './cart_header.php'; ?>
    </div>

    <?php
        function clearCart() {
            if (isset($_SESSION['cartBW'])) {
                unset($_SESSION['cartBW']);
                echo "<script>alert('Cart cleared successfully.');</script>";
                echo "<script>window.location.href = window.location.href;</script>";
                exit;
            } else {
                echo "<script>alert('Cart is already empty.');</script>";
            }
        }

        if (isset($_POST['clear_cart'])) {
            clearCart();
        }
        $cartNotEmpty = isset($_SESSION['cartBW']) && !empty($_SESSION['cartBW']);
    ?>

    <div class="main_container_div">
        <h1 class="h1">Booking Cart</h1>
        <?php if ($cartNotEmpty): ?>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th class="m_fail_img">Image</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cartBW'] as $cartItem): ?>
                        <tr class="cart-item">
                            <td class="m_fail_img"><img src="<?= $cartItem['images'][0] ?>" alt="Product Image" class="product-image"></td>
                            <td class="productName"><?= $cartItem['productName'] ?></td>
                            <td><?= $cartItem['price'] ?></td>
                            <td><?= $cartItem['startDate'] ?></td>
                            <td><?= $cartItem['endDate'] ?></td>
                            <td><?= $cartItem['size'] ?></td>
                            <td>
                                <input type="number" class="quantity-input" value="<?= $cartItem['quantity'] ?>" min="1" data-price="<?= $cartItem['price'] ?>">
                            </td>
                            <td class="subtotal"><?= $cartItem['price'] * $cartItem['quantity'] ?></td>
                            <td><a class="remove" href="remove_item.php?ID=<?= $cartItem['ID'] ?>">Remove</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="total_info">
            <h2>Total Bill: <span id="total-bill"></span></h2>
            
            <div class="buttonsOfCart_main">
                <form method="post">
                    <button class="clearBtn" type="submit" name="clear_cart">Clear Cart</button>
                </form>
                <a class="buttonsOfCart" href="./BW_Rent_Out.php"><button class="btn">Continue Shopping</button></a>
                <a class="buttonsOfCart2" href="./save_rental_oders.php"><button class="btn">Confirm Rental</button></a>
            </div>
        </div>

        <script>
            const quantityInputs = document.querySelectorAll('.quantity-input');

            function updateTotals() {
                let total = 0;
                quantityInputs.forEach(input => {
                    const quantity = parseInt(input.value);
                    const price = parseFloat(input.dataset.price);
                    const subtotal = quantity * price;
                    const subtotalCell = input.parentElement.nextElementSibling;
                    subtotalCell.textContent = subtotal.toFixed(2);
                    total += subtotal;
                });
                document.getElementById('total-bill').textContent = total.toFixed(2);
            }

            quantityInputs.forEach(input => {
                input.addEventListener('change', updateTotals);
            });

            updateTotals();
        </script>

        <?php else: ?>
            <img src="./IMAGES/backgrounds/pngegg.png" class="emptyCartImg" alt="">
            <p class="empty_note">Your shopping cart is empty.</p>
            <a class="buttonsOfEmptyCart" href="./BW_Rent_Out.php"><button class="btn">Continue Shopping</button></a>
        <?php endif; ?>
    </div>
</body>
</html>
