<?php
session_start();
include('connection.php');

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['cost']) && isset($_POST['status'])) {
    $serviceId = $_POST['id'];
    $serviceName = trim($_POST['name']);
    $description = trim($_POST['description']);
    $cost = $_POST['cost'];
    $status = (int)$_POST['status'];

    // Validate inputs
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

    // Fetch current image path to preserve old image if no new image is uploaded
    $query = "SELECT service_img FROM service_list WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $serviceId);
    $stmt->execute();
    $stmt->bind_result($existingImage);
    $stmt->fetch();
    $stmt->close();

    $newImagePath = $existingImage;  // Default to the existing image

    // Handle Image Upload (if new image is uploaded)
// Handle Image Upload (if new image is uploaded)
if (!empty($_FILES['service_img']['name'])) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['service_img']['type'], $allowedTypes)) {
        $_SESSION['status'] = 'Only JPG, PNG, and GIF files are allowed.';
        $_SESSION['status_icon'] = 'error';
        header("Location: ../service_list.php");
        exit();
    }

    $imageName = time() . '_' . $_FILES['service_img']['name'];
    $targetDirectory = "../uploads/";
    $targetFilePath = $targetDirectory . $imageName;

    // Ensure directory exists
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    if (move_uploaded_file($_FILES['service_img']['tmp_name'], $targetFilePath)) {
        if (!empty($existingImage) && file_exists("../uploads/" . $existingImage)) {
            unlink("../uploads/" . $existingImage);
        }

        $newImagePath = $imageName;
    } else {
        $_SESSION['status'] = 'Failed to upload new image.';
        $_SESSION['status_icon'] = 'error';
        header("Location: ../service_list.php");
        exit();
    }
}


    // Update Service
    $query = "UPDATE service_list SET name = ?, description = ?, cost = ?, status = ?, service_img = ?, date_updated = NOW() WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssdisi', $serviceName, $description, $cost, $status, $newImagePath, $serviceId);

    // Execute query
    if ($stmt->execute()) {
        $_SESSION['status'] = 'Service updated successfully.';
        $_SESSION['status_icon'] = 'success';
    } else {
        $_SESSION['status'] = 'Failed to update service.';
        $_SESSION['status_icon'] = 'error';
    }

    header("Location: ../service_list.php");
    exit();
}
?>
