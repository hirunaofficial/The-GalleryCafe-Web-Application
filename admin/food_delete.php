<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sqlDelete = "DELETE FROM Menu WHERE MenuID = ?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) {
        echo "Food item deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
