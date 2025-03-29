<?php
include 'connection.php';

// Query to count service selections
$query = "
    SELECT 
        sl.name AS service_name,
        COUNT(asv.service_id) AS booking_count
    FROM 
        service_list sl
    JOIN 
        appointment_service asv ON sl.id = asv.service_id
    GROUP BY 
        sl.name
    ORDER BY 
        booking_count DESC
";

$result = $conn->query($query);

$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'service_name' => $row['service_name'],
            'booking_count' => (int)$row['booking_count']
        ];
    }
}

// Return data as JSON
echo json_encode($data);
?>
