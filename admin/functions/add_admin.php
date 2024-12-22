<?php
include 'connection.php';
session_start();  // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Encrypt the password

    $avatar = $_POST['currentAvatar'];  // Handle current avatar for existing users
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../uploads/";
        $avatar = time() . '_' . basename($_FILES["avatar"]["name"]);
        $targetFile = $targetDir . $avatar;
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile);
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO users (firstname, middlename, lastname, username, password, avatar, type, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $status = 1;  // Active by default
    $type = 2;  // Assuming '2' is the type for admin
    $stmt->bind_param("ssssssii", $firstname, $middlename, $lastname, $username, $password, $avatar, $type, $status);

    if ($stmt->execute()) {
        $_SESSION['status'] = 'Admin added successfully';
        $_SESSION['status_icon'] = 'success';
    } else {
        $_SESSION['status'] = 'Failed to add admin. Please try again.';
        $_SESSION['status_icon'] = 'error';
    }

    $stmt->close();
    $conn->close();

    header("Location: ../users.php");
    exit();
}
?>
