<?php

include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $userId = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;
    $usertype = $_POST['usertype'];

    $sql = "UPDATE Users SET FullName = '$fullname', Email = '$email', Phone = '$phone', UserType = '$usertype'";
    if ($password) {
        $sql .= ", Password = '$password'";
    }
    $sql .= " WHERE UserID = '$userId'";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>