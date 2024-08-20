<?php
include '../config.php';

// Check if form data is provided
if (isset($_POST['id'], $_POST['parkingspotnumber'], $_POST['status'])) {
    $parkingId = intval($_POST['id']);
    $spotNumber = $_POST['parkingspotnumber'];
    $status = $_POST['status'];

    // Update parking details
    $sql = "UPDATE ParkingAvailability SET ParkingSpotNumber = ?, AvailabilityStatus = ? WHERE ParkingID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $spotNumber, $status, $parkingId);
    
    if ($stmt->execute()) {
        echo "Parking spot updated successfully";
    } else {
        echo "Error updating parking spot: " . $stmt->error;
    }
    
    $stmt->close();
}
?>
