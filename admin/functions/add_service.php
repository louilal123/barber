<?php
session_start(); 
include('connection.php'); 

// Check if form is submitted
if (isset($_POST['add_service'])) {
    $serviceName = trim($_POST['name']);
    $description = trim($_POST['description']);
    $cost = $_POST['cost'];
    $status = (int)$_POST['status'];

    // Image Upload Logic
    $targetDir = "../uploads/";
    $imageName = basename($_FILES['service_img']['name']);
    $imagePath = $targetDir . $imageName;

    // Check for valid image types
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    $imageType = $_FILES['service_img']['type'];

    if (!in_array($imageType, $allowedTypes)) {
        $_SESSION['status'] = 'Invalid image format. Only JPG, PNG, and GIF are allowed.';
        $_SESSION['status_icon'] = 'error';
        header("Location: ../service_list.php");
        exit();
    }

    // Move uploaded image to the uploads directory
    if (!move_uploaded_file($_FILES['service_img']['tmp_name'], $imagePath)) {
        $_SESSION['status'] = 'Failed to upload image. Please try again.';
        $_SESSION['status_icon'] = 'error';
        header("Location: ../service_list.php");
        exit();
    }

    // Insert service data with image path into the database
    $query = "INSERT INTO service_list (name, description, service_img, cost, status, date_created, date_updated) 
              VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssdi', $serviceName, $description, $imageName, $cost, $status);

    if ($stmt->execute()) {
        $_SESSION['status'] = 'Service added successfully.';
        $_SESSION['status_icon'] = 'success';
    } else {
        $_SESSION['status'] = 'Failed to add service. Please try again.';
        $_SESSION['status_icon'] = 'error';
    }

    header("Location: ../service_list.php");
    exit();
}
?>
