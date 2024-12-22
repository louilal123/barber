<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT id, firstname, middlename, lastname, username, password, avatar, last_login, type, status, date_added, date_updated 
    FROM users 
    WHERE username = '$username'";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Check if the account is active
            if ($user['status'] == '1') {
                // Set all session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['middlename'] = $user['middlename'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['fullname'] = $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['avatar'] = $user['avatar'];
               
                $_SESSION['type'] = $user['type'];
                $_SESSION['status'] = $user['status'];
                $_SESSION['date_added'] = $user['date_added'];
                $_SESSION['date_updated'] = $user['date_updated'];

                // Success message
                $_SESSION['status'] = "Login successful!";
                $_SESSION['status_icon'] = "success";

                // Redirect to the dashboard
                header("Location: ../dashboard.php");
            } else {
                // Inactive account error
                $_SESSION['status'] = "Your account is inactive. Please contact the administrator.";
                $_SESSION['status_icon'] = "error";
                header("Location: ../index.php");
            }
        } else {
            // Invalid password error
            $_SESSION['status'] = "Invalid password. Please try again.";
            $_SESSION['status_icon'] = "error";
            header("Location: ../index.php");
        }
    } else {
        // User not found error
        $_SESSION['status'] = "User not found. Please check your credentials.";
        $_SESSION['status_icon'] = "error";
        header("Location: ../index.php");
    }
}
?>
