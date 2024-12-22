<?php
include 'connection.php';

session_start();  // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['adminId'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $role = $_POST['role'];

    $photo = $_POST['currentPhoto'];
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../uploads/";
        $photo = time() . '_' . basename($_FILES["photo"]["name"]);
        $targetFile = $targetDir . $photo;
        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);
    }

    $stmt = $conn->prepare("UPDATE users SET email = ?, username = ?, fullname = ?, role = ?, photo = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $email, $username, $fullname, $role, $photo, $id);

    if ($stmt->execute()) {
        $_SESSION['status'] = 'Admin updated successfully';
        $_SESSION['status_icon'] = 'success';
    } else {
        $_SESSION['status'] = 'Failed to update admin. Please try again.';
        $_SESSION['status_icon'] = 'error';
    }

    $stmt->close();
    $conn->close();

    header("Location: ../users.php");
    exit();
}
?>
