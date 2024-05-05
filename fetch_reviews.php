<?php
include("db_connect.php");

// Fetch the number of reviews from the database
$query = $conn->query("SELECT review_count FROM rating_star");
if ($query && $query->num_rows > 0) {
    $row = $query->fetch_assoc();
    $num_reviews = $row['review_count'];

    // Echo the number of reviews as the response
    echo $num_reviews;
} else {
    // If no rows are returned, echo a default value or an error message
    echo "No reviews found";
}
?>
