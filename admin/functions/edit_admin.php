<?php
include('connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $avatar = $_FILES['avatar']['name'];

    // Handle avatar upload if a new avatar is provided
    if ($avatar) {
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($avatar);
        move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile);
    }

    // Update query for admin data (split full name into parts if necessary)
    $nameParts = explode(' ', $fullname);
    $firstname = $nameParts[0];
    $middlename = isset($nameParts[1]) ? $nameParts[1] : '';
    $lastname = isset($nameParts[2]) ? $nameParts[2] : '';

    // Query to update the admin details
    $query = "UPDATE users SET firstname=?, middlename=?, lastname=?, username=?, avatar=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $firstname, $middlename, $lastname, $username, $avatar, $id);
    
    if ($stmt->execute()) {
        $_SESSION['status'] = "Admin updated successfully!";
        $_SESSION['status_icon'] = "success";
    } else {
        $_SESSION['status'] = "Failed to update admin!";
        $_SESSION['status_icon'] = "error";
    }
    header('Location: ../admin/users.php'); // Redirect back to users page
}
?>
