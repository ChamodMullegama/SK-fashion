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
                include_once("./Includes/Customer_reviews.php");
                $db = new Connection();
                $conn = $db->getConnection();
                
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $id = isset($_GET['id']) ? $_GET['id'] : null;
                    if ($id) {
                        $stmt = $conn->prepare("SELECT * FROM clothing_items WHERE id = :id");
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $item = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($item) {
                            // Step 3: Calculate discounted price if discount is available
                            if (is_numeric($item['discounts'])) {
                                $discounted_price = $item['price'] - ($item['price'] * ($item['discounts'] / 100));
                            } else {
                                // If discount is not available or not a valid number, use the original price
                                $discounted_price = $item['price'];
                            }
                        
                        // Add this code after fetching the item details
                        $reviewsHandler = new ReviewHandler();
                        $reviews = $reviewsHandler->getReviews("reviews", $item['id']);
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
                                                                $images = explode(',', $item['images']);

                                                                foreach ($images as $index => $image) {
                                                                ?>
                                                                    <li class="sliderBlock_items__itemPhoto <?php echo ($index === 0) ? 'sliderBlock_items__showing' : ''; ?>">
                                                                        <img src="<?php echo $image; ?>" alt="Product Image <?php echo $index + 1; ?>">
                                                                    </li>
                                                                <?php
                                                                }
                                                            ?>
                                                        </ul>

                                                        <div class="sliderBlock_controls">
                                                            <div class="sliderBlock_controls__navigatin">
                                                                <div class="sliderBlock_controls__wrapper">
                                                                    <div class="sliderBlock_controls__arrow sliderBlock_controls__arrowBackward">
                                                                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="sliderBlock_controls__arrow sliderBlock_controls__arrowForward">
                                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <ul class="sliderBlock_positionControls">
                                                                <?php
                                                                    // Add a paginator item for each image
                                                                    for ($i = 0; $i < count($images); $i++) {
                                                                ?>
                                                                    <li class="sliderBlock_positionControls__paginatorItem <?php echo ($i === 0) ? 'sliderBlock_positionControls__active' : ''; ?>"></li>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </ul>
                                                        </div>
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
                                                        <h2 class="block_name block_name__mainName"><?php echo $item['productName']; ?><sup>&reg; </sup></h2>
                                                        <h2 class="block_name block_name__addName"><?php echo $item['category']; ?></h2>

                                                        <p class="block_product__advantagesProduct">
                                                            <?php echo $item['brand']; ?>
                                                        </p>

                                                        <div class="block_informationAboutDevice">



                                                            <div class="block_descriptionInformation">
                                                                <span>
                                                                    <?php echo $item['description']; ?>
                                                                </span>
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
                                                                    <?php if (is_numeric($item['discounts'])) : ?>
                                                                        <p class="block_price__currency">Rs<?php echo $discounted_price; ?></p>
                                                                        <p class="block_price__discounted">(Discounted Price)</p>
                                                                        <p class="block_price__original">Original Price: Rs<?php echo $item['price']; ?></p>
                                                                    <?php else : ?>
                                                                        <p class="block_price__currency">Rs<?php echo $item['price']; ?></p>
                                                                    <?php endif; ?>
                                                                    <p class="block_price__shipping">Shipping and taxes extra</p>
                                                                </div>
                                                                </div>

                                                                <form action="cart.php" method="post">
                                                                    <div class="sizesAndAll">
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
                                                                            $availabilityStatus = $item['availabilityStatus'];
                                                                            if ($availabilityStatus == 'available') {
                                                                                echo '<span style="color: green; margin: 0; padding: 0; top: 0;"> Quantity - ' . $availabilityStatus . '</span>';
                                                                            } else {
                                                                                echo '<span style="color: red; margin: 0; padding: 0; top: 0;">   Quantity - ' . $availabilityStatus . '</span>';
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                        <input type="hidden" name="itemId" value="<?php echo $item['id']; ?>">
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

                <div class="row_02">
                    <div class="row_part_01">
                        <div class="viewcontainer">
                            <h1>Customer Reviews</h1>

                            <?php foreach ($reviews as $review): ?>
                                <div class="review-card">
                                    <p><strong><?= $review['customer_name'] ?>:</strong> <?= $review['body'] ?></p>

                                    <div class='custom-rating-stars'>
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?php
                                            $starClass = ($i <= $review['rating']) ? 'custom-filled-star' : 'custom-empty-star';
                                            ?>
                                            <span class='<?= $starClass ?>'>&#9733;</span>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                                                                    
                        <div class="container_add_review">
                            <h1>Customer Reviews</h1>
                            <p>Click on "Write a Review" to share your experience!</p>

                            <form action="./Includes/customer_reviews.php" id="reviewFormContent" method="post">
                            <label for="name">Name:</label>
                            <input type="text" id="customer_name" name="customer_name" required>

                            <label for="email">Email:</label>
                            <input type="text" id="customer_email" name="customer_email" required>


                            <label for="rating">Rating:</label>
                            <input type="hidden" name="rating" id="rating" value="">

                            <div class="stars-container">
                                <div id="rating" class="stars">
                                <span class="star" data-value="5">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="1">&#9733;</span>
                            </div>
                        
                            <label for="title">Review Title:</label>
                            <input type="text" id="title" name="title" required>

                            <label for="body">Review Body:</label>
                            <textarea id="body" name="body" rows="5" required></textarea>

                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                            <button class="rviews_btn" type="submit" name="submit">Submit Review</button>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    const stars = document.querySelectorAll('.star');
                    const rating = document.getElementById('rating');
                    let selectedRating = 0;

                    stars.forEach(star => {
                        star.addEventListener('click', function() {
                            selectedRating = parseInt(this.getAttribute('data-value'));
                            highlightStars(selectedRating);
                            rating.value = selectedRating;  // Set the value in the hidden input
                        });
                    });

                    function highlightStars(value) {
                        stars.forEach(star => {
                            star.classList.toggle('active', parseInt(star.getAttribute('data-value')) <= value);
                        });
                    }
                </script>

                <div class="aboutMe">
                    <a href="https://codepen.io/BlackStar1991/pens/public/" target="_new">
                        <i class='fa fa-codepen'></i> my other Pens</a>
                </div>


                <div class="container">
                </div>
        <?php
        } else {
            //case ID is not found
            echo "Item not found.";
        }
        } else {
            //invalid or missing ID
            echo "Invalid item ID";
        }
        } else {
            //case form not submitted
            echo "Form not submitted.";
        }
        ?>
        <script src="./js/pr.js"></script>
</body>
</html>