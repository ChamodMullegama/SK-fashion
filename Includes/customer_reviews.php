<?php

include_once __DIR__ . "/connection.php";

class ReviewHandler
{
    private $conn;

    public function __construct()
    {
        $db = new Connection();
        $this->conn = $db->getConnection();
    }

    public function handleReview($table, $reviewTable, $redirectPage)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $name = $_POST['customer_name'];
            $email = $_POST['customer_email'];
            $rating = $_POST['rating'];
            $title = $_POST['title'];
            $body = $_POST['body'];
            $item_id = $_POST['item_id'];


            $checkStmt = $this->conn->prepare("SELECT id FROM $table WHERE id = :item_id ");
            $checkStmt->bindParam(':item_id', $item_id);
            $checkStmt->execute();

            if ($checkStmt->rowCount() > 0) {
                $stmt = $this->conn->prepare("INSERT INTO $reviewTable (customer_name, customer_email, rating, title, body, item_id) VALUES (:customer_name, :customer_email, :rating, :title, :body, :item_id)");
                $stmt->bindParam(':customer_name', $name);
                $stmt->bindParam(':customer_email', $email);
                $stmt->bindParam(':rating', $rating);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':body', $body);
                $stmt->bindParam(':item_id', $item_id);

                if ($stmt->execute()) {
                    echo "Review submitted successfully!";
                    header("Location: $redirectPage"); 
                    exit();
                } else {
                    echo "Error submitting review.";
                }
            } else {
             
            }
        } else {
    
        }
    }


    public function getReviews($reviewTable, $item_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $reviewTable WHERE item_id = :item_id");
        $stmt->bindParam(':item_id', $item_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
// Usage for the first scenario
$handler1 = new ReviewHandler();
$handler1->handleReview("clothing_items", "reviews", "../category.php");

// Usage for the second scenario
$handler2 = new ReviewHandler();
$handler2->handleReview("clothing_items_bridal_wear", "reviews_bw", "../BridalWear.php");
?>