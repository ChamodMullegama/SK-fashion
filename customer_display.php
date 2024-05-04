<?php
require_once './Includes/connection.php'; // Include your database connection file

$db = new connection();
$conn = $db->getConnection();

// Fetch customer data
$query = "SELECT * FROM customer";
$stmt = $conn->prepare($query);
$stmt->execute();
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$numCustomers = count($customers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Data</title>
    <link rel="stylesheet" href="./Styles/Admin_Styles/customer_display.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>

    <?php
        include("./header.php");
    ?>

        <div class="boxes" id="customer-box">
            <div class="top">
                <h3><?php echo $numCustomers; ?></h3>
                <span class="material-symbols-outlined">groups</span>
            </div>
            
            <h2>Total Customers</h3>
        </div>

        <div class="reviews-box">
            <div class="review-top">
                <h1>Customer Reviews</h1>
                <span class="material-symbols-outlined">reviews</span>
            </div>
            <a href="./customer_reviews.php">View</a>
        </div>

    <table border="1">
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?php echo $customer['customer_id']; ?></td>
                <td><?php echo $customer['customer_name']; ?></td>
                <td><?php echo $customer['customer_email']; ?></td>
                <td class="<?php echo ($customer['customer_vstatus'] == 1) ? 'verified' : 'unverified'; ?>">
                    <?php echo ($customer['customer_vstatus'] == 1) ? 'Verified' : 'Unverified'; ?>
                </td>
                <td>
                    <button id="delete" onclick="deleteCustomer(<?php echo $customer['customer_id']; ?>)">Delete</button>
                    <button id="viewMore" onclick="viewMore(
                            <?php echo $customer['customer_id']; ?>,
                            '<?php echo htmlspecialchars($customer['customer_name']); ?>',
                            '<?php echo htmlspecialchars($customer['customer_email']); ?>',
                            <?php echo $customer['customer_vstatus']; ?>,
                            '<?php echo htmlspecialchars($customer['firstName']); ?>',
                            '<?php echo htmlspecialchars($customer['lastName']); ?>',
                            '<?php echo htmlspecialchars($customer['addressLine1']); ?>',
                            '<?php echo htmlspecialchars($customer['addressLine2']); ?>',
                            '<?php echo htmlspecialchars($customer['town']); ?>',
                            '<?php echo htmlspecialchars($customer['postalCode']); ?>',
                            '<?php echo htmlspecialchars($customer['Profile_image']); ?>'
                        )">View More</button>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Modal for customer details -->
    <div id="customerModal" class="modal">
        <div class="modal-content" id="customerDetails">
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
    </div>

    <script>
    function deleteCustomer(customerId) {
        // Implement your delete logic here
        alert('Delete customer with ID ' + customerId);
    }

    function viewMore(customerId, customerName, customerEmail,customerVStatus,customerfirstName,customerlastName,  addressLine1, addressLine2, town, postalCode, profileImage) {
        // Fetch customer details via AJAX or include them in the PHP loop
        var customerDetails = `
            <h2>${customerId}</h2>
            <p>Name: ${customerName}</p>
            <p>Email: ${customerEmail}</p>
            <p>Status: ${customerVStatus == 1 ? 'Verified' : 'Unverified'}</p>
            <p>First Name: ${customerfirstName}</p>
            <p>Last Name: ${customerlastName}</p>   
            <p>Address: ${addressLine1}, ${addressLine2}, ${town}, ${postalCode}</p>
            <img class="profile-pic" src="${profileImage}" alt="Profile Picture">
            <button class="close-button" onclick="closeModal()">Close</button>
        `;
        // Add more details as needed

        // Display details in the modal
        document.getElementById('customerDetails').innerHTML = customerDetails;
        document.getElementById('customerModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('customerModal').style.display = 'none';
    }

    // Close the modal when clicking outside of it
    window.onclick = function (event) {
        var modal = document.getElementById('customerModal');
        if (event.target === modal) {
            closeModal();
        }
    };
</script>
</body>
</html>