<?php
session_start();
include 'connection.php';  // Include your database connection file

// Fetch admin id from session
$admin_id = $_SESSION['user_id'];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];

    // Prepare and execute the query to update the profile
    $stmt = $conn->prepare("UPDATE users SET firstname = ?, middlename = ?, lastname = ?, username = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $firstname, $middlename, $lastname, $username, $admin_id);
    $stmt->execute();

    // Check if a new avatar is uploaded
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $avatar = $_FILES['avatar'];

        // Validate the uploaded file (allowed types)
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));

        if (in_array($file_extension, $allowed_extensions)) {
            // Generate a unique file name
            $avatar_name = uniqid('avatar_', true) . '.' . $file_extension;

            // Move the uploaded file to the "uploads" folder
            $upload_dir = '../uploads/';
            if (move_uploaded_file($avatar['tmp_name'], $upload_dir . $avatar_name)) {
                // Update the avatar path in the database
                $stmt = $conn->prepare("UPDATE users SET avatar = ? WHERE id = ?");
                $stmt->bind_param("si", $avatar_name, $admin_id);
                $stmt->execute();
            } else {
                $_SESSION['status'] = 'Error uploading the file.';
                $_SESSION['status_icon'] = 'error';
            }
        } else {
            $_SESSION['status'] = 'Invalid file type. Please upload a JPG, JPEG, PNG, or GIF image.';
            $_SESSION['status_icon'] = 'error';
        }
    }

    $_SESSION['status'] = 'Profile information updated successfully.';
    $_SESSION['status_icon'] = 'success';
    header("Location: ../profile.php");
    exit();
}
?>
