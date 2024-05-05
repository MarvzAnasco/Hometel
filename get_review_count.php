<?php
include("db_connect.php");

// Check if categoryId is set and numeric
if(isset($_POST['categoryId']) && is_numeric($_POST['categoryId'])) {
    $categoryId = $_POST['categoryId'];

    // Fetch review count from the database for the given category ID
    $query = "SELECT review_count FROM rating_star WHERE id = '$categoryId'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['review_count'];
    } else {
        // If no record exists, return 0
        echo '0';
    }
} else {
    // Return error message for invalid category ID
    echo 'Invalid category ID';
}
?>
