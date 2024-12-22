<?php
session_start(); // Start the session to use session variables
include('connection.php'); // Include your database connection file

// Check if form is submitted
if (isset($_POST['add_service'])) {
    // Get the form data
    $serviceName = trim($_POST['name']);
    $description = trim($_POST['description']);
    $cost = $_POST['cost'];
    $status = (int) $_POST['status']; // Directly cast the status to an integer (1 or 0)


    // Validate service name and description (no numeric or special characters allowed)
    if (!preg_match("/^[a-zA-Z\s]+$/", $serviceName)) {
        $_SESSION['status'] = 'Service name should not contain numbers or special characters.';
        $_SESSION['status_icon'] = 'error';
        header("Location: ../service_list.php");
        exit();
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $description)) {
        $_SESSION['status'] = 'Description should not contain numbers or special characters.';
        $_SESSION['status_icon'] = 'error';
        header("Location: ../service_list.php");
        exit();
    }

    // Prepare the SQL statement to insert the service into the database
    $query = "INSERT INTO service_list (name, description, cost, status, date_created, date_updated) 
              VALUES (?, ?, ?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssdi', $serviceName, $description, $cost, $status);

    // Execute the query
    if ($stmt->execute()) {
        $_SESSION['status'] = 'Service added successfully.';
        $_SESSION['status_icon'] = 'success';
    } else {
        $_SESSION['status'] = 'Failed to add service. Please try again.';
        $_SESSION['status_icon'] = 'error';
    }

    // Redirect to the page with the modal
    header("Location: ../service_list.php");
    exit();
}
?>
