<?php
session_start();
include 'connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
    // Get and sanitize the data
    $id = intval($_POST['id']);
    $status = intval($_POST['status']); // 1 for Verified, 0 for Unverified

    // Prepare and execute the update query
    $query = "UPDATE appointment_list SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $status, $id);

    if ($stmt->execute()) {
        $_SESSION['status'] = ($status == 1) 
            ? 'Appointment has been verified successfully.' 
            : 'Appointment has been unverified successfully.';
        $_SESSION['status_icon'] = 'success';
    } else {
        $_SESSION['status'] = 'Failed to update appointment status. Please try again.';
        $_SESSION['status_icon'] = 'error';
    }
    $stmt->close();
    header("Location: ../appointments_list.php"); // Redirect back to the appointments_list page
    exit();
} else {
    $_SESSION['status'] = 'Invalid request.';
    $_SESSION['status_icon'] = 'error';
    header("Location: ../appointments_list.php");
    exit();
}
?>
