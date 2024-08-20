<?php
include '../config.php';

// Check if form data is provided
if (isset($_POST['id'], $_POST['capacity'], $_POST['status'])) {
    $tableId = intval($_POST['id']);
    $capacity = $_POST['capacity'];
    $status = $_POST['status'];

    // Update table details
    $sql = "UPDATE TableCapacities SET Capacity = ?, AvailabilityStatus = ? WHERE TableID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $capacity, $status, $tableId);
    
    if ($stmt->execute()) {
        echo "Table updated successfully";
    } else {
        echo "Error updating table: " . $stmt->error;
    }
    
    $stmt->close();
}
?>
