<?php
session_start();
include 'connection.php'; // Include your database connection file

// Fetch admin id from session
$admin_id = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate new password and confirm password
    if ($new_password !== $confirm_password) {
        $_SESSION['status'] = 'New password and confirm password do not match.';
        $_SESSION['status_icon'] = 'error';
        header('Location: ../profile.php');
        exit();
    }

    // Fetch the current password from the database
    $sql = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if ($hashed_password) {
        // Verify current password
        if (password_verify($current_password, $hashed_password)) {
            // Hash the new password
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_sql = "UPDATE users SET password = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $new_hashed_password, $admin_id);

            if ($update_stmt->execute()) {
                $_SESSION['status'] = 'Password updated successfully.';
                $_SESSION['status_icon'] = 'success';
            } else {
                $_SESSION['status'] = 'Failed to update password. Please try again.';
                $_SESSION['status_icon'] = 'error';
            }
            $update_stmt->close();
        } else {
            $_SESSION['status'] = 'Current password is incorrect.';
            $_SESSION['status_icon'] = 'error';
        }
    } else {
        $_SESSION['status'] = 'User not found.';
        $_SESSION['status_icon'] = 'error';
    }

    // Redirect back to the profile page
    header('Location: ../profile.php');
    exit();
}
?>
