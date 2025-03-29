<?php
session_start();

// Ensure the user is logged in and has the required type (admin in this case)
if (!isset($_SESSION['user_id']) || $_SESSION['type'] !== '1') {
    http_response_code(404);
    include('404.html');
    exit;
}

// Fetch details from the session
$admin_id = $_SESSION['user_id'];
$admin_firstname = $_SESSION['firstname'];
$admin_middlename = $_SESSION['middlename'];
$admin_lastname = $_SESSION['lastname'];
$admin_fullname = $_SESSION['fullname'];
$admin_username = $_SESSION['username'];
$admin_avatar = $_SESSION['avatar'];
$admin_type = $_SESSION['type'];
$admin_date_added = $_SESSION['date_added'];
$admin_date_updated = $_SESSION['date_updated'];


?>
