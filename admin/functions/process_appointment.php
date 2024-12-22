<?php
session_start(); // Start session to use session variables

// Include the database connection file
include 'connection.php';

if (isset($_POST['book_appointment'])) {
    // Retrieve the form data
    $fullname = $_POST['fullname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $schedule = $_POST['schedule'];
    $selected_services = $_POST['service_id']; // Array of selected service IDs

    // Start a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Insert the appointment into the appointment_list table
        $stmt = $conn->prepare("INSERT INTO appointment_list (fullname, contact, email, schedule, status, total, date_created, date_updated) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $status = 'pending'; // Assuming the initial status is 'pending'
        $total = 0; // Start with 0 total cost, we will calculate it later
        $stmt->bind_param('sssssd', $fullname, $contact, $email, $schedule, $status, $total);
        $stmt->execute();
        $appointment_id = $stmt->insert_id; // Get the ID of the inserted appointment

        // Insert the selected services into the appointment_service table
        $total_cost = 0;
        foreach ($selected_services as $service_id) {
            // Retrieve the cost of the service
            $service_stmt = $conn->prepare("SELECT cost FROM service_list WHERE id = ?");
            $service_stmt->bind_param('i', $service_id);
            $service_stmt->execute();
            $service_stmt->store_result();
            $service_stmt->bind_result($cost);
            $service_stmt->fetch();

            // Insert into appointment_service table
            $service_stmt2 = $conn->prepare("INSERT INTO appointment_service (appointment_id, service_id, cost) VALUES (?, ?, ?)");
            $service_stmt2->bind_param('iid', $appointment_id, $service_id, $cost);
            $service_stmt2->execute();

            // Add the service cost to the total cost
            $total_cost += $cost;
        }

        // Update the total cost in the appointment_list table
        $update_stmt = $conn->prepare("UPDATE appointment_list SET total = ?, date_updated = NOW() WHERE id = ?");
        $update_stmt->bind_param('di', $total_cost, $appointment_id);
        $update_stmt->execute();

        // Commit the transaction
        $conn->commit();

        // Set session status and redirect
        $_SESSION['status'] = 'Booking added successfully!';
        $_SESSION['status_icon'] = 'success';
        header("Location: ../../book_appointment.php"); // Redirect to a success page
        exit();
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();

        // Set session status for error
        $_SESSION['status'] = 'Booking failed. Please try again.';
        $_SESSION['status_icon'] = 'error';
        header("Location: ../../book_appointment.php"); // Redirect to an error page
        exit();
    }
}
?>
