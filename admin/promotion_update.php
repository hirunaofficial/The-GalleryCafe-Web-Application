<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $promotionName = $_POST['promotionname'];
    $description = $_POST['description'];
    $startDate = $_POST['startdate'];
    $endDate = $_POST['enddate'];
    $imageURL = $_POST['imageurl'];

    $sqlUpdate = "UPDATE Promotions SET PromotionName = ?, Description = ?, StartDate = ?, EndDate = ?, ImageURL = ? WHERE PromotionID = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("sssssi", $promotionName, $description, $startDate, $endDate, $imageURL, $id);

    if ($stmt->execute() === TRUE) {
        echo "Promotion details updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
