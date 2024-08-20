<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $eventName = $_POST['eventname'];
    $description = $_POST['description'];
    $eventDate = $_POST['eventdate'];
    $imageURL = $_POST['imageurl'];

    $sqlUpdate = "UPDATE SpecialEvents SET EventName = ?, Description = ?, EventDate = ?, ImageURL = ? WHERE EventID = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("ssssi", $eventName, $description, $eventDate, $imageURL, $id);

    if ($stmt->execute() === TRUE) {
        echo "Event details updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
