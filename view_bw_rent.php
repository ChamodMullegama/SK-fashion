<?php include './includes/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Styles/Admin_Styles/add_item.css">
    <style>
        .rentals_table{
            width: 96%;
            margin-left: 2%;
        }
        .table_rent{
            margin-top: 150px !important;
        }
        table #btnUpdate{
            background-color: hsl(143, 35%, 44%);
        }

        table #btnUpdate:hover{
            background-color: hsl(143, 35%, 34%);
        }

        table #btnDelete{
            background-color: hsl(0, 57%, 50%);
            margin-top: 5px;
        }

        table #btnDelete:hover{
            background-color: hsl(0, 57%, 40%);
        }
        tr td a{
            padding: 10px 10px;
            text-decoration: none;
            color: white !important;
        }
    </style>
</head>
<body>
    <?php include("./header.php")?>

    <?php
    $db = new connection();
    $conn = $db->getConnection();

    $sql = "SELECT * FROM rented_clothes";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
        echo "<div class='rentals_table'>";
        echo "<table class='table_rent' border='1'>
                <tr>
                    <th>ID</th>
                    <th>Cloth Name</th>
                    <th>Material</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sizes</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['cloth_name']}</td>
                    <td>{$row['material']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['category']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['sizes_BW']}</td>
                    <td><img src='{$row['image_path']}' alt='Cloth Image' style='width: 100px; height: 140px;'></td>
                    <td>
                        <a id='btnUpdate' href='update_bw_rent.php?id={$row['id']}'>Update</a>
                        <a id='btnDelete' href='delete_bw_rent.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
        }

        echo "</table>";
        echo "</div>";
    } else {
        echo "No clothing available.";
    }
    ?>
</body>
</html>