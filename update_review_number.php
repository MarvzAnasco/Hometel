<?php
include("db_connect.php");

// Check if categoryId and review are set
if(isset($_POST['categoryId'], $_POST['review'])) {
    $categoryId = $_POST['categoryId'];
    $review = $_POST['review'];

    // Update the review count in the database for the given category ID
    $updateQuery = "UPDATE rating_star SET review_count = '$review' WHERE id = '$categoryId'";

    if(mysqli_query($con, $updateQuery)) {
        // Return success message
        echo "Review count updated successfully";
    } else {
        // Return error message
        echo "Error updating review count: " . mysqli_error($con);
    }
} else {
    // Return error message for invalid data
    echo "Invalid data provided";
}
?>
