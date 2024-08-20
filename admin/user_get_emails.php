<?php

include '../config.php';

// Fetch all user emails from the database
$sql = "SELECT Email FROM Users";
$result = $conn->query($sql);

$emails = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $emails[] = $row['Email'];
    }
}

echo implode("\n", $emails);

?>