<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $reservationDate = $_POST['reservationdate'];
    $reservationTime = $_POST['reservationtime'];
    $tableCapacity = $_POST['tablecapacity'];
    $parkingRequired = $_POST['parkingrequired'];
    $message = $_POST['message'];
    $status = $_POST['status'];

    $sqlUpdate = "UPDATE Reservations SET ReservationDate = ?, ReservationTime = ?, TableCapacity = ?, ParkingRequired = ?, Message = ?, Status = ? WHERE ReservationID = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("ssssssi", $reservationDate, $reservationTime, $tableCapacity, $parkingRequired, $message, $status, $id);

    if ($stmt->execute() === TRUE) {
        echo "Reservation details updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>