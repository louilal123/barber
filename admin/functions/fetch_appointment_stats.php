<?php
include 'connection.php'; // Adjust to your DB connection file

// Query: Group by month for the current year
$query = "
    SELECT 
        MONTH(schedule) AS month,
        SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS verified,
        SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) AS unverified
    FROM appointment_list
    WHERE YEAR(schedule) = YEAR(CURDATE())
    GROUP BY MONTH(schedule)
    ORDER BY MONTH(schedule)
";

$result = $conn->query($query);

// Initialize an array for all 12 months
$data = [];
for ($i = 1; $i <= 12; $i++) {
    $data[$i] = ['month' => $i, 'verified' => 0, 'unverified' => 0];
}

// Populate the data array with actual counts from the database
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[(int)$row['month']]['verified'] = (int)$row['verified'];
        $data[(int)$row['month']]['unverified'] = (int)$row['unverified'];
    }
}

// Ensure data is ordered by month
$data = array_values($data); // Convert associative array to indexed array

header('Content-Type: application/json');
echo json_encode($data);
?>