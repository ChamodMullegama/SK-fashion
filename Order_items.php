<?php
    $currentPage = 'NULL';
    $currentPage_M = 'orders';
    require_once "./Includes/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
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

    <div class="container-xl px-4 mt-4" id="Profile">
        <div class="row" id="row">
            <div class="col-xl-4">
                    <?php
                    if (isset($_SESSION['customer_name'])) {
                        $connection = new connection();
                        $conn = $connection->getConnection();
                        $customer_id = $_SESSION['customer_id'];
                        $sql = "SELECT * FROM customer WHERE customer_id = :customer_id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':customer_id', $customer_id);
                        if ($stmt->execute()) {
                            $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
                        } else {
                            echo "Error fetching user details from the database";
                        }
                    } else {
                        header("Location: login.php");
                        exit();
                    }
                    ?>
            </div>
            <?php
            $sqlOrders = "SELECT * FROM orders WHERE customer_name = :customer_name ORDER BY order_date DESC";
            $stmtOrders = $conn->prepare($sqlOrders);
            $stmtOrders->bindParam(':customer_name', $_SESSION['customer_name']);
            $stmtOrders->execute();
            $orders = $stmtOrders->fetchAll(PDO::FETCH_ASSOC);
            $groupedOrders = array();
            foreach ($orders as $order) {
                $orderDate = date('F j, Y - H:i:s', strtotime($order['order_date']));
                $status = $order['confirm_status'] == 0 ? 'Pending' : 'Confirmed';
                $groupedOrders[$orderDate][$status][] = $order;
            }
            ?>
            <div class="oders" style="margin-top: 8vh;">
                <?php foreach ($groupedOrders as $orderDate => $statuses) : ?>
                    <div class="card mb-4" style="margin-top: -0vh;">
                        <div class="card-header">Order Details - <?= $orderDate ?></div>
                        <div class="card-body">
                            <?php foreach ($statuses as $status => $ordersGroup) : ?>
                                <h5 style="color: <?= $status == 'Pending' ? 'red' : 'green' ?>"><?= $status ?> Orders</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Size</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $totalPrice = 0;
                                            foreach ($ordersGroup as $order) :
                                                $totalPrice += $order['subtotal'];
                                            ?>
                                                <tr>
                                                    <td><?= $order['item_name'] ?></td>
                                                    <td><?= $order['price'] ?></td>
                                                    <td><?= $order['quantity'] ?></td>
                                                    <td><?= $order['size'] ?></td>
                                                    <td><?= $order['subtotal'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="4"><strong>Total:</strong></td>
                                                <td><?= $totalPrice ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <form action="cancel_order.php" method="POST">
                                    <input type="hidden" name="order_date" value="<?= $orderDate ?>">
                                    <input type="hidden" name="order_time" value="<?= $order['order_time'] ?>">
                                    <input type="hidden" name="status" value="<?= $status ?>">
                                    <button class="btn btn-danger" type="submit" name="cancel_order">Cancel <?= $status ?> Orders</button>
                                </form>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>