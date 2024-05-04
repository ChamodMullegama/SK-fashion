<?php
    $currentPage = 'NULL';
?>

<?php
    include_once("./hub_nav.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/pr.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/css/foundation.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (3).png" type="image/x-icon">
    <title>SK Fashion Hub</title>
</head>

<body style="background-color: rgba(0, 0, 0, 0.05);">
    <?php
        include_once("./Includes/connection.php");

        $db = new connection();
        $conn = $db->getConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            if ($id) {
                $stmt = $conn->prepare("SELECT * FROM rented_clothes WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $item = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
            <section>
                <main class="main">
                    <div class="mainWrapper">
                        <div class="mainBackground clearfix">
                            <div class="row">
                                <div class="column small-centered">
                                    <div class="productCard_block">
                                        <div class="row">
                                            <div class="small-12 large-6 columns">
                                                <div class="productCard_leftSide clearfix">
                                                    <div class="productCard_brendBlock">
                                                        <a class="productCard_brendBlock__imageBlock" href="#">
                                                            <img src="./IMAGES/logo/Copy of Black White Minimalist Aesthetic Letter Initial Name Monogram Logo (1).png" alt="" height="50px" width="60px">
                                                        </a>
                                                    </div>

                                                    <div class="sliderBlock">
                                                        <ul class="sliderBlock_items">
                                                            <?php
                                                                $images = explode(',', $item['image_path']);

                                                                foreach ($images as $index => $image) {
                                                                ?>
                                                                    <li class="sliderBlock_items__itemPhoto <?php echo ($index === 0) ? 'sliderBlock_items__showing' : ''; ?>">
                                                                        <img src="<?php echo $image; ?>" alt="Product Image <?php echo $index + 1; ?>">
                                                                    </li>
                                                                <?php
                                                                }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="small-12 large-6 columns">
                                                <div class="productCard_rightSide">
                                                    <div class="block_specification">
                                                        <div class="block_specification__specificationShow">
                                                            <i class="fa fa-cog block_specification__button block_specification__button__rotate" aria-hidden="true"></i>
                                                            <span class="block_specification__text">spec</span>
                                                        </div>
                                                        <div class="block_specification__informationShow hide">
                                                            <i class="fa fa-info-circle block_specification__button block_specification__button__jump" aria-hidden="true"></i>
                                                            <span class="block_specification__text">inform</span>
                                                        </div>
                                                    </div>

                                                    <p class="block_model">
                                                        <span class="block_model__text">Model: </span>
                                                        <span class="block_model__number"><?php echo $item['id']; ?></span>
                                                    </p>

                                                    <div class="block_product">
                                                        <h2 class="block_name block_name__mainName"><?php echo $item['cloth_name']; ?><sup>&reg; </sup></h2>
                                                        <h2 class="block_name block_name__addName"><?php echo $item['category']; ?></h2>

                                                        <p class="block_product__advantagesProduct">
                                                            <?php echo $item['material']; ?>
                                                        </p>

                                                        <div class="block_informationAboutDevice">



                                                            <div class="block_descriptionInformation">
                                                                <span>
                                                                    <?php echo $item['description']; ?>
                                                                </span>
                                                                <br><b><span><i class="bi bi-exclamation-circle-fill"></i> Rent-outs Are Only Available For Polonnaruwa Area</span></b>
                                                            </div>

                                                            <div class="block_rating clearfix">
                                                                <fieldset class="block_rating__stars">
                                                                    <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                                    <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                                    <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Good - 4 stars"></label>
                                                                    <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Above average - 3.5 stars"></label>
                                                                    <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Average - 3 stars"></label>
                                                                    <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                                    <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                                    <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                                    <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                                    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                </fieldset>

                                                                <span class="block_rating__avarage">4.25</span>
                                                                <span class="block_rating__reviews">(153 reviews)</span>

                                                            </div>
                                                            <div class="row ">
                                                                <div class="large-6 small-12 column left-align">
                                                                    <div class="block_price">
                                                                        <p class="block_price__currency"> Rs<?php echo $item['price']; ?></p>
                                                                        <p class="block_price__shipping">Shipping and taxes extra</p>
                                                                    </div>
                                                                </div>

                                                                <form action="./Includes/cart_BW_rent_process.php" method="post">
                                                                    <div class="sizesAndAll">
                                                                        <div class="setDate">
                                                                            <label for='getDate' class='text_specification'>Select Start Date:</label>
                                                                            <input type='date' name='startDate' id='startDate' class="S_Edates">
                                                                            <label for='dueDate' class='text_specification'>Select End Date:</label>
                                                                            <input type='date' name='endDate' id='endDate' class="S_Edates">
                                                                        </div>
                                                                        <label for="sizeSelect" class="text_specification">Choose your size:</label>
                                                                        <div class="block_goodSize__allSizes">
                                                                            <select name="sizeOfItem" id="sizeSelect" class="block_goodSize__select">
                                                                                <option class="size" value="S">S</option>
                                                                                <option class="size" value="M">M</option>
                                                                                <option class="size" value="L">L</option>
                                                                                <option class="size" value="XL">XL</option>
                                                                                <option class="size" value="XXL">XXL</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <span class="text_specification" style="width: 100%;">
                                                                            <?php
                                                                            // Check the availability status and set the color accordingly
                                                                            $availabilityStatus = $item['availability'];
                                                                            if ($availabilityStatus == 'available') {
                                                                                echo '<span style="color: green; margin: 0; padding: 0; top: 0;"> Quantity - ' . $availabilityStatus . '</span>';
                                                                            } else {
                                                                                echo '<span style="color: red; margin: 0; padding: 0; top: 0;">   Quantity - ' . $availabilityStatus . '</span>';
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                        <input type="hidden" name="ID" value="<?php echo $item['id']; ?>">
                                                                        <div class="btn_and_qty">
                                                                            <div class="block_quantity__chooseBlock">
                                                                                <label for="quantityNumber">Quantity:</label>
                                                                                <input class="block_quantity__number" name="quantityNumber" type="number" min="1" value="1">
                                                                            </div>
                                                                            <div class="btn_addToCart">
                                                                                <button class="submit" type="submit" name="submit">Add to Cart</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>

                </main>

                <div class="aboutMe">
                    <a href="https://codepen.io/BlackStar1991/pens/public/" target="_new">
                        <i class='fa fa-codepen'></i> my other Pens</a>
                </div>


                <div class="container">
                  

                 <!-- Display all images -->
                    
                </div>
        <?php
        } else {
            // Handle invalid or missing ID
            echo "Invalid item ID";
        }
    } else {
        // Handle cases where the form was not submitted
        echo "Form not submitted.";
    }
    ?>
</body>

</html>