<?php
    require_once './Includes/connection.php';

    $db = new connection();
    $conn = $db->getConnection();

    $query1 = "SELECT * FROM reviews";
    $stmt1 = $conn->prepare($query1);
    $stmt1->execute();
    $fh_reviews = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    $query2 = "SELECT * FROM reviews_bw";
    $stmt2 = $conn->prepare($query2);
    $stmt2->execute();
    $bw_reviews = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/Admin_Styles/customer_reviews.css">
    <title>Document</title>
</head>
<body>
    <?php
        include("./header.php");
    ?>

    <h1>Customer Reviews</h1>

    <div class="all-reviews-box">
        <div class="fh-review-box">
            <h2>Fashion Hub Reviews</h2>
            <table border="1">
                <tr>
                    <th>Customer Name</th>
                    <th>Item Id</th>
                    <th>Review body</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($fh_reviews as $fh_review): ?>
                    <tr>
                        <td><?php echo $fh_review['customer_name']; ?></td>
                        <td><?php echo $fh_review['item_id']; ?></td>
                        <td><?php echo $fh_review['body']; ?></td>
                        <td>⭐<?php echo $fh_review['rating']; ?></td>
                        <td>
                            <form action="./fh_reviews_delete.php" method="post">
                                <input type="hidden" name="review_id" value="<?php echo $fh_review['review_id']; ?>">
                                <button id="delete" type="submit" name="delete_fh_item">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="fh-review-box">
            <h2>Bridal Wear Reviews</h2>
            <table border="1">
                <tr>
                    <th>Customer Name</th>
                    <th>Item Id</th>
                    <th>Review body</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($bw_reviews as $bw_review): ?>
                    <tr>
                        <td><?php echo $bw_review['customer_name']; ?></td>
                        <td><?php echo $bw_review['item_id']; ?></td>
                        <td><?php echo $bw_review['body']; ?></td>
                        <td>⭐<?php echo $bw_review['rating']; ?></td>
                        <td>
                        <form action="./bw_reviews_delete.php" method="post">
                            <input type="hidden" name="review_id" value="<?php echo $bw_review['id']; ?>">
                            <button id="delete" type="submit" name="delete_bw_item">Delete</button>
                        </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>