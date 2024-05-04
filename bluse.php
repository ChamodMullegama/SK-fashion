<?php
    $currentPage = 'bridal_wear';
    include_once("./BridalWear_header.php");
?>
<?php
    include_once "./Includes/connection.php";
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $itemId = $_GET['id'];
        $db = new Connection();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM custom_clothes WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $itemId);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Item Details</title>
                <link rel="stylesheet" href="styles.css">
                <link rel="stylesheet" href="./Styles/rental_items.css">
            </head>
            <body>            
                <div class="main_con_div">
                    <div class="left">
                        <h2 class="topic">Item Details</h2>
                        <div class="product-details">
                            <img class="p_image" src="<?php echo $item['image_path']; ?>" alt="<?php echo $item['cloth_name']; ?>">
                        </div>
                    </div>   
                    
                    <div class="right">
                        <h2 class="name"><?php echo $item['cloth_name']; ?></h2>
                        <p class="price">Price: Rs <?php echo $item['price']; ?></p>
                        <p>Material: <?php echo $item['material']; ?></p>
                        <p class="des"><?php echo $item['description']; ?></p>
                        <form method="post" action="./Includes/custom_bl_process.php">
                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                            <div class="parts_in_row">
                                <div class="input_div">
                                    <label class="tags" for="shoulder">Shoulder:</label>
                                    <input type="text" name="shoulder" id="shoulder"><br>
                                </div>

                                <div class="input_div">
                                    <label class="tags" for="front_w">Front W:</label>
                                    <input type="text" name="front_w" id="front_w"><br>
                                </div>
                            </div>
                            
                            <div class="parts_in_row">
                                <div class="input_div">
                                    <label class="tags" for="back_w">Back W:</label>
                                    <input type="text" name="back_w" id="back_w"><br>
                                </div>

                                <div class="input_div">
                                    <label class="tags" for="bust_point_w">Bust Point W:</label>
                                    <input type="text" name="bust_point_w" id="bust_point_w"><br>
                                </div>
                            </div>

                            <div class="parts_in_row">
                                <div class="input_div">
                                    <label class="tags" for="bust_l">Bust L:</label>
                                    <input type="text" name="bust_l" id="bust_l"><br>
                                </div>

                                <div class="input_div">
                                    <label class="tags" for="bra_cut_l">Bra Cut L:</label>
                                    <input type="text" name="bra_cut_l" id="bra_cut_l"><br>
                                </div>
                            </div>
                            
                            <div class="parts_in_row">
                                <div class="input_div">
                                    <label class="tags" for="upper_bust">Upper Bust:</label>
                                    <input type="text" name="upper_bust" id="upper_bust"><br>
                                </div>

                                <div class="input_div">
                                    <label class="tags" for="bust">Bust:</label>
                                    <input type="text" name="bust" id="bust"><br>
                                </div>
                            </div>

                            <div class="parts_in_row">
                                <div class="input_div">
                                    <label class="tags" for="bra_cut_waist">Bra Cut Waist:</label>
                                    <input type="text" name="bra_cut_waist" id="bra_cut_waist"><br>
                                </div>

                                <div class="input_div">
                                    <label class="tags" for="waist">Waist:</label>
                                    <input type="text" name="waist" id="waist"><br>
                                </div>
                            </div>
                            
                            <div class="parts_in_row">
                                <div class="input_div">
                                    <label class="tags" for="waist_jacket_length">Waist from Jacket Length:</label>
                                    <input type="text" name="waist_jacket_length" id="waist_jacket_length"><br>
                                </div>

                                <div class="input_div">
                                    <label class="tags" for="armhole">Armhole:</label>
                                    <input type="text" name="armhole" id="armhole"><br>
                                </div>
                            </div>

                            <div class="parts_in_row">
                                <div class="input_div">
                                    <label class="tags" for="sofa">SOFA:</label>
                                    <input type="text" name="sofa" id="sofa"><br>
                                </div>

                                <div class="input_div">
                                    <label class="tags" for="sl_l">SL L:</label>
                                    <input type="text" name="sl_l" id="sl_l"><br>
                                </div>
                            </div>

                            <div class="parts_in_row">
                                <div class="input_div">
                                    <label class="tags" for="sl_open">SL Open:</label>
                                    <input type="text" name="sl_open" id="sl_open"><br>
                                </div>

                                <div class="input_div">
                                    <label class="tags" for="neck_depth">Neck Depth:</label>
                                    <input type="text" name="neck_depth" id="neck_depth"><br>
                                </div>
                            </div>

                            <div class="input_div">
                                <label class="tags" for="saree_jacket_open_side">Saree Jacket Open side:</label>
                                <input type="text" name="saree_jacket_open_side" id="saree_jacket_open_side"><br>
                            </div>

                            <button type="submit" class="add-to-cart">ADD TO CART</button>
                        </form>
                    </div>
                </div>
            </body>
            </html>
        <?php
            } else {
                echo "Item not found.";
            }
        } else {
            echo "Invalid request.";
        }
?>