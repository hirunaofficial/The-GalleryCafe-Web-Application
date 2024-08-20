<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sqlDelete = "DELETE FROM SpecialEvents WHERE EventID = ?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) {
        echo "Event deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
