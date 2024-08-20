<?php
session_start();
include '../config.php';

// Check if the user is logged in and has the appropriate role (Admin or Staff)
if (!in_array($_SESSION['UserType'], ['Admin', 'Staff'])) {
    echo "Unauthorized access";
    exit();
}

// Get data from the form
$promotionName = $_POST['promotionname'];
$description = $_POST['description'];
$startDate = $_POST['startdate'];
$endDate = $_POST['enddate'];
$imageURL = $_POST['imageurl'];

// Insert promotion into the database
$sql = "INSERT INTO Promotions (PromotionName, Description, StartDate, EndDate, ImageURL)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssss', $promotionName, $description, $startDate, $endDate, $imageURL);

if ($stmt->execute()) {
    echo "Promotion added successfully!";
} else {
    echo "Error adding promotion: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
