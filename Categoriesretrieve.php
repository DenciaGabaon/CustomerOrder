<?php
header('Content-Type: application/json');
include 'db.php';

$query = "SELECT CategoryID FROM category";
$result = $conn->query($query);
$categories = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['CategoryID'];
    }
}

echo json_encode($categories);
$conn->close();
?>
