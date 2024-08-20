<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $orderDate = $_POST['orderdate'];
    $status = $_POST['status'];

    $sqlUpdate = "UPDATE PreOrders SET Quantity = ?, OrderDate = ?, Status = ? WHERE PreOrderID = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("issi", $quantity, $orderDate, $status, $id);

    if ($stmt->execute() === TRUE) {
        echo "Pre-order details updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
