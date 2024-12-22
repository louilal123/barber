<?php
session_start();
include('connection.php'); // Include your database connection file

// Check if form is submitted
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['cost']) && isset($_POST['status'])) {
    // Get the form data
    $serviceId = $_POST['id'];
    $serviceName = trim($_POST['name']);
    $description = trim($_POST['description']);
    $cost = $_POST['cost'];
    $status = (int) $_POST['status']; // Convert status to integer (1 or 0)

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

    // Prepare the SQL statement to update the service in the database
    $query = "UPDATE service_list SET name = ?, description = ?, cost = ?, status = ?, date_updated = NOW() WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssdis', $serviceName, $description, $cost, $status, $serviceId);

    // Execute the query
    if ($stmt->execute()) {
        $_SESSION['status'] = 'Service updated successfully.';
        $_SESSION['status_icon'] = 'success';
    } else {
        $_SESSION['status'] = 'Failed to update service. Please try again.';
        $_SESSION['status_icon'] = 'error';
    }

    // Redirect to the service list page
    header("Location: ../service_list.php");
    exit();
}
?>
