<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "SELECT PreOrders.*, Users.FullName, Menu.MenuName, Menu.Price FROM PreOrders 
            JOIN Users ON PreOrders.UserID = Users.UserID 
            JOIN Menu ON PreOrders.MenuID = Menu.MenuID 
            WHERE PreOrderID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode([]);
    }

    $stmt->close();
}

$conn->close();
?>
