<?php
include 'connection.php';

session_start();  // Start the session

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['status'] = 'Admin deleted successfully';
        $_SESSION['status_icon'] = 'success';
    } else {
        $_SESSION['status'] = 'Service deletion failed. Please try again.';
        $_SESSION['status_icon'] = 'error';
    }

    $stmt->close();
    $conn->close();

    header("Location: ../users.php");
    exit();
}
?>
