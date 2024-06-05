<?php
include 'db.php'; // Include your database connection file

// Query to get the last OrderID
$query = "SELECT `OrderID` FROM `orders` ORDER BY `OrderID` DESC LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Fetch the row
    $row = $result->fetch_assoc();
    $lastOrderID = $row['OrderID'];
    echo json_encode(["lastOrderID" => $lastOrderID]);
} else {
    echo json_encode(["error" => "No orders found."]);
}

$conn->close();
?>
