<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menuname = $_POST['menuname'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $cuisinetype = $_POST['cuisinetype'];
    $imageurl = $_POST['imageurl'];

    $sqlAdd = "INSERT INTO Menu (MenuName, Description, Price, CuisineType, ImageURL) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlAdd);
    $stmt->bind_param("ssdss", $menuname, $description, $price, $cuisinetype, $imageurl);

    if ($stmt->execute() === TRUE) {
        echo "New food item added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
