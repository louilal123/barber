<?php
session_start(); // Start the session to use session variables
include('connection.php');

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Prepare the SQL statement to delete the appointment
    $query = "DELETE FROM appointment_list WHERE id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $appointmentId);
        if ($stmt->execute()) {
            // Set session message for successful deletion
            $_SESSION['status'] = 'Appointment deleted successfully.';
            $_SESSION['status_icon'] = 'success';
        } else {
            // Set session message for failed deletion
            $_SESSION['status'] = 'Failed to delete the appointment. Please try again.';
            $_SESSION['status_icon'] = 'error';
        }
    } else {
        // Handle error preparing the query
        $_SESSION['status'] = 'Error preparing the deletion query.';
        $_SESSION['status_icon'] = 'error';
    }
} else {
    // No ID passed
    $_SESSION['status'] = 'Appointment ID not found.';
    $_SESSION['status_icon'] = 'error';
}

// Redirect to the appointments page with the session status message
header("Location: ../appointments_list.php");
exit();
?>
