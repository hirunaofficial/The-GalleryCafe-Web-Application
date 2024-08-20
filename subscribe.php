<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['EMAIL']);

    // Check if email is already subscribed
    $checkEmail = "SELECT * FROM Subscribers WHERE Email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "<script>alert('This email is already subscribed.'); window.history.back();</script>";
    } else {
        $sql = "INSERT INTO Subscribers (Email) VALUES ('$email')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Thank you for subscribing!'); window.history.back();</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "'); window.history.back();</script>";
        }
    }
}

$conn->close();
?>