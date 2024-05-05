<?php
include("db_connect.php");

// Check if categoryId, review, and currentIndex are set
if(isset($_POST['categoryId'], $_POST['review'], $_POST['currentIndex'])) {
    $categoryId = $_POST['categoryId'];
    $review = $_POST['review'];

    // Fetch the current value of star_index_X from the database
    $fetchQuery = "SELECT star_index_" . $_POST['currentIndex'] . " FROM rating_star WHERE id = ?";
    $stmt = $con->prepare($fetchQuery);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $stmt->bind_result($currentValue);
    $stmt->fetch();
    $stmt->close();

    // Increment the current value by one
    $newValue = $currentValue + 1;

    // Update the value of star_index_X in the database
    $updateQuery = "UPDATE rating_star SET star_index_" . $_POST['currentIndex'] . " = ? WHERE id = ?";
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("ii", $newValue, $categoryId);
    if($stmt->execute()) {
        // Increment the review_count by one
        $incrementQuery = "UPDATE rating_star SET review_count = review_count + 1 WHERE id = ?";
        $stmt = $con->prepare($incrementQuery);
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();

        // Fetch the updated review count
        $review_count_query = "SELECT review_count FROM rating_star WHERE id = ?";
        $stmt = $con->prepare($review_count_query);
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $stmt->bind_result($review_count);
        $stmt->fetch();
        $stmt->close();

        // Return the categoryId, updated review count, and new star_index_X value as a response
        echo json_encode(array('categoryId' => $categoryId, 'review_count' => $review_count, 'star_index' => $newValue));
    } else {
        echo "Error updating star_index_X value: " . $stmt->error;
    }
} else {
    echo "Invalid data provided";
}
?>
