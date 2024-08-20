<?php
include '../config.php';

// Check if the ID is provided
if (isset($_POST['id'])) {
    $parkingId = intval($_POST['id']);

    // Fetch parking details
    $sql = "SELECT * FROM ParkingAvailability WHERE ParkingID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $parkingId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $parking = $result->fetch_assoc();
        echo json_encode($parking);
    } else {
        echo json_encode(['error' => 'Parking spot not found']);
    }
    
    $stmt->close();
}
?>
