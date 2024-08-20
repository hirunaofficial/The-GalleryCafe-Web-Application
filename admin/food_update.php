<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $menuname = $_POST['menuname'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $cuisinetype = $_POST['cuisinetype'];
    $imageurl = $_POST['imageurl'];

    $sqlUpdate = "UPDATE Menu SET MenuName = ?, Description = ?, Price = ?, CuisineType = ?, ImageURL = ? WHERE MenuID = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("ssdssi", $menuname, $description, $price, $cuisinetype, $imageurl, $id);

    if ($stmt->execute() === TRUE) {
        echo "Food item updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
