<?php
include 'connection.php';

// Correct Query: Ensure 'schedule' is treated as a valid date
$query = "
      SELECT 
        MONTH(schedule) AS month,
        SUM(total) AS total_income
    FROM appointment_list
    WHERE YEAR(schedule) = YEAR(CURDATE()) 
      AND total IS NOT NULL
      AND total > 0
      AND status = 1
    GROUP BY MONTH(schedule)
    ORDER BY MONTH(schedule)
";

$result = $conn->query($query);

// Initialize array with all 12 months set to 0
$data = array_fill(1, 12, ['total_income' => 0]);

// Populate array with fetched data
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = (int)$row['month'];
        $data[$month]['total_income'] = (int)$row['total_income'];
    }
}

// Return data in the correct month order
echo json_encode(array_values($data));
?>
