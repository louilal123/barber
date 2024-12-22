<?php
session_start(); // Start the session to store messages

include('connection.php'); // Make sure your connection file is included

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Prepare the SQL query to delete the service
    $query = "DELETE FROM service_list WHERE id = ?";
    
    // Prepare statement
    if ($stmt = $conn->prepare($query)) {
        // Bind the service ID to the prepared statement
        $stmt->bind_param("i", $service_id);
        
        // Execute the query
        if ($stmt->execute()) {
            // Set session status for success
            $_SESSION['status'] = 'Service deleted successfully.';
            $_SESSION['status_icon'] = 'success';
        } else {
            // Set session status for failure
            $_SESSION['status'] = 'Service deletion failed. Please try again.';
            $_SESSION['status_icon'] = 'error';
        }
        $stmt->close();
    } else {
        // If the statement preparation fails, set the error status
        $_SESSION['status'] = 'Service deletion failed. Please try again.';
        $_SESSION['status_icon'] = 'error';
    }

    // Close the database connection
    $conn->close();
} else {
    // If no ID is provided, set an error message
    $_SESSION['status'] = 'No service selected for deletion.';
    $_SESSION['status_icon'] = 'error';
}

// Redirect back to the service list page
header("Location: ../service_list.php");
exit();
?>
