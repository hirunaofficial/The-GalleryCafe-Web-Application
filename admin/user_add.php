<?php
include '../config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $usertype = $_POST['usertype'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    // Check if email already exists
    $sqlCheckEmail = "SELECT * FROM Users WHERE Email = '$email'";
    $result = $conn->query($sqlCheckEmail);

    if ($result->num_rows > 0) {
        echo "Email already exists.";
        exit();
    }

    // Insert new user into the database
    $sqlAdd = "INSERT INTO Users (FullName, Email, Phone, Password, UserType) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlAdd);
    $stmt->bind_param("sssss", $fullname, $email, $phone, $password, $usertype);

    if ($stmt->execute() === TRUE) {
        echo "New user added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>