<?php
header('Content-Type: application/json');
include 'db.php';

$query = "SELECT CustomerID FROM customer";
$result = $conn->query($query);
$customers = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row['CustomerID'];
    }
}

echo json_encode($customers);
$conn->close();
?>
