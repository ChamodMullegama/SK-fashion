<?php
    // Include header
    include "./header.php";

    // Include database connection file
    require_once "./Includes/connection.php";

    // Initialize database connection
    $db = new connection();
    $conn = $db->getConnection();

    // Fetch total number of customers
    $query_customers = "SELECT COUNT(*) AS total_customers FROM customer";
    $stmt_customers = $conn->prepare($query_customers);
    $stmt_customers->execute();
    $total_customers = $stmt_customers->fetch(PDO::FETCH_ASSOC)['total_customers'];

    $db = new connection();
    $conn = $db->getConnection();

    // Fetch orders data from the database
    $query_orders = "SELECT * FROM orders ORDER BY order_date ASC";
    $stmt_orders = $conn->prepare($query_orders);
    $stmt_orders->execute();
    $orders = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Styles/Admin_Styles/admin_home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <h1>DASHBOARD</h1>

    <div class="details-container">
        
        <div class="boxes" id="customer-box">
            <div class="top">
                <h3><?php echo $total_customers; ?></h3>
                <span class="material-symbols-outlined">groups</span>
            </div>
            
            <h2>Total Customers</h3>
        </div>

        <div class="boxes" id="sales-box">
            <div class="top">
                <h3>4</h3>
                <span class="material-symbols-outlined">monitoring</span>
            </div>

            <h2>Total Sales</h3>
        </div>

        <div class="boxes" id="orders-box">
            <div class="top">
            <?php
                // Fetch total number of orders
                $query_total_orders = "SELECT COUNT(*) AS total_orders FROM orders";
                $stmt_total_orders = $conn->prepare($query_total_orders);
                $stmt_total_orders->execute();
                $total_orders_count = $stmt_total_orders->fetch(PDO::FETCH_ASSOC)['total_orders'];
                echo "<h3>$total_orders_count</h3>";
            ?>
                <span class="material-symbols-outlined">local_shipping</span>
            </div>
            
            <h2>Total Orders</h3>
        </div>
        
    </div>

    <table border="1">
        <tr>
            <th>Order date and Time</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Total Amount</th>
            <th>Action</th>
        </tr>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo $order['customer_name']; ?></td>
                <td>
                    <?php echo $order['address_line1']; ?>
                    <?php echo $order['address_line2']; ?>
                    <?php echo $order['town']; ?>
                </td>
                <td><?php echo $order['subtotal']; ?></td>
                <td class="actions">
                    <a href="#" onclick="viewOrderDetails('<?php echo htmlentities(json_encode($order)); ?>')">View order details</a>
                    <!-- Add order_id as a parameter to viewOrderDetails -->
                    <a href="#" onclick="confirmOrder(<?php echo $order['order_id']; ?>)">Confirm order</a>
                    <a href="#" onclick="cancelOrder(<?php echo $order['order_id']; ?>)">Cancel order</a> <!-- Call cancelOrder function -->
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    

    <div class="popup-overlay" id="popup">
        <div class="popup">
            <h2>Order Details</h2>
            <div id="order-details">
                
            </div>
            <button onclick="closePopup()">Close</button>
        </div>
    </div>

    <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            margin-top: 5%;
        }

        .popup {
            background-color: hsl(219, 18%, 15%);
            padding: 20px;
            border-radius: 5px;
            font-size: 1.2rem;
            line-height: 1.5;
        }

        .popup h2 {
            margin-top: 0;
        }

        .popup button {
            margin-top: 10px;
            padding: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            background-color: #7ed6df;
        }

        .popup button:hover{
            background-color: #22a6b3;
        }
    </style>

    <script>
        function viewOrderDetails(orderDetails) {
            var order = JSON.parse(orderDetails);
            var popup = document.getElementById("popup");
            var orderDetailsDiv = document.getElementById("order-details");
            var html = "<strong>Order Date and Time:</strong> " + order.order_date + "<br>";
            html += "<strong>Customer Name:</strong> " + order.customer_name + "<br>";
            html += "<strong>Address:</strong> " + order.address_line1 + ", " + order.address_line2 + ", " + order.town + "<br>";
            html += "<strong>Postal Code:</strong> " + order.postal_code + "<br>";
            html += "<strong>Email:</strong> " + order.email + "<br>";
            html += "<strong>Phone Number:</strong> " + order.phone_number + "<br>";
            html += "<strong>Item Name:</strong> " + order.item_name + "<br>";
            html += "<strong>Size:</strong> " + order.size + "<br>";
            html += "<strong>Price:</strong> $" + order.price + "<br>";
            html += "<strong>Quantity:</strong> " + order.quantity + "<br>";
            html += "<strong>Total Amount:</strong> $" + order.subtotal + "<br>";
            orderDetailsDiv.innerHTML = html;
            popup.style.display = "flex";
        }

        function closePopup() {
            var popup = document.getElementById("popup");
            popup.style.display = "none";
        }

        function confirmOrder(orderId) {
        // Make AJAX request to confirm_order.php
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    if(response.status === "success") {
                        alert(response.message);
                        // Optionally, you can update the UI here after successful confirmation
                    } else {
                        alert(response.message);
                    }
                }
            };
            xhttp.open("POST", "confirm_order.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("order_id=" + orderId);
        }

        function cancelOrder(orderId) {
            var confirmation = confirm("Are you sure you want to cancel this order?");
            if (confirmation) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        if (response.status === "success") {
                            alert(response.message);
                            // Optionally, you can update the UI here after successful cancellation
                            location.reload(); // Reload the page to reflect the changes
                        } else {
                            alert(response.message);
                        }
                    }
                };
                xhttp.open("POST", "cancel_order.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("order_id=" + orderId);
            }
        }
    </script>
</body>
</html>