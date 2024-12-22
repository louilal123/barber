<?php
include "connection.php";

if (isset($_GET['id'])) {
    $appointmentId = intval($_GET['id']); // Sanitize input

    // Query to fetch the appointment details
    $appointmentQuery = "
        SELECT 
            id, fullname, contact, email, schedule, status, total 
        FROM appointment_list 
        WHERE id = {$appointmentId}
    ";
    $appointmentResult = $conn->query($appointmentQuery);
    $appointment = $appointmentResult->fetch_assoc();

    // Query to fetch the services for the appointment
    $servicesQuery = "
        SELECT 
            aservice.service_id, 
            aservice.cost, 
            s.name AS service_name 
        FROM appointment_service aservice
        INNER JOIN service_list s ON aservice.service_id = s.id
        WHERE aservice.appointment_id = {$appointmentId}
    ";
    $servicesResult = $conn->query($servicesQuery);

    $services = [];
    while ($row = $servicesResult->fetch_assoc()) {
        $services[] = $row;
    }

    echo json_encode([
        'appointment' => $appointment,
        'services' => $services,
    ]);
    exit;
}
?>
