<?php
session_start();
include '../config.php';

// Check if the user is logged in and has the appropriate role (Admin or Staff)
if (!in_array($_SESSION['UserType'], ['Admin', 'Staff'])) {
    echo "Unauthorized access";
    exit();
}

// Get data from the form
$eventName = $_POST['eventname'];
$description = $_POST['description'];
$eventDate = $_POST['eventdate'];
$imageURL = $_POST['imageurl'];

// Insert event into the database
$sql = "INSERT INTO SpecialEvents (EventName, Description, EventDate, ImageURL)
        VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $eventName, $description, $eventDate, $imageURL);

if ($stmt->execute()) {
    echo "Event added successfully!";
} else {
    echo "Error adding event: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
