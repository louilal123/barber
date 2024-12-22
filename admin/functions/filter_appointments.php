<?php
include 'connection.php';

if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];  // The selected month (01-12)
    $year = $_GET['year'];    // The selected year (YYYY)

    // Query to fetch verified appointments for the selected month and year
    $query = "
        SELECT id, fullname, contact, email, schedule, status, total, date_created, date_updated 
        FROM appointment_list
        WHERE status = 1 
        AND MONTH(schedule) = ? 
        AND YEAR(schedule) = ?
    ";

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('ii', $month, $year);  // Bind the month and year to the query
        $stmt->execute();
        $result = $stmt->get_result();  // Get the result of the query

        // Initialize an empty array to store the fetched appointments
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;  // Add each appointment to the array
        }

        // Return the data as a JSON response
        echo json_encode($appointments);

        $stmt->close();  // Close the prepared statement
    } else {
        echo json_encode(['error' => 'Failed to prepare the query.']);
    }
} else {
    echo json_encode(['error' => 'Month and year are required.']);
}
?>
