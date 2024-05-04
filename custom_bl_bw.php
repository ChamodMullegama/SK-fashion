<?php
    $currentPage = 'bridal_wear';
    include_once("./BridalWear_header.php");
?>
<?php
include './includes/connection.php';

$db = new connection();
$conn = $db->getConnection();

// Query the database for items with the "Osari" category
$sql = "SELECT * FROM custom_clothes WHERE category = 'blues'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$osariItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/bridalWear.css">
    <title>Jacket Items</title>
</head>
<body>
    <div class="container">
        <h2 style="padding-bottom: 30px;">Jackets</h2>
        <div class="row_products">
            <?php foreach ($osariItems as $item): ?>
                <div class="column_product">
                    <div class="product">
                        <img class="p_image" src="<?php echo $item['image_path']; ?>" alt="<?php echo $item['cloth_name']; ?>">
                        <h2 class="name"><?php echo $item['cloth_name']; ?></h2>
                        <p class="price">Price: Rs <?php echo $item['price']; ?></p>
                        <p style="margin-top: -15px;">Material: <?php echo $item['material']; ?></p>
                        <!-- Add other relevant information about the item here -->
                        <form method="get" action="./bluse.php">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <button type="submit" class="add-to-cart">ADD TO CART</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>