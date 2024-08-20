<?php
include '../config.php';

// Check if the ID is provided
if (isset($_POST['id'])) {
    $tableId = intval($_POST['id']);

    // Fetch table details
    $sql = "SELECT * FROM TableCapacities WHERE TableID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tableId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $table = $result->fetch_assoc();
        echo json_encode($table);
    } else {
        echo json_encode(['error' => 'Table not found']);
    }
    
    $stmt->close();
}
?>