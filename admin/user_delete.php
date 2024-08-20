<?php

include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $userId = $_POST['id'];

    $sql = "DELETE FROM Users WHERE UserID = '$userId'";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully.";
    } else {
     echo "Error: " . $conn->error;
    }
}

?>