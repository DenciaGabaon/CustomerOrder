<?php 
include 'db.php'; // Include your database connection file

// Query to get the number of products per category
$sql = "SELECT CategoryID, COUNT(*) AS ProductCount FROM product GROUP BY CategoryID";
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

$labels = [];
$counts = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $labels[] = "Category " . $row['CategoryID'];
        $counts[] = $row['ProductCount'];
    }
} else {
    echo "0 results";
}

// Query to get the summary of orders over time (example: by month)
$sql_orders = "SELECT DATE_FORMAT(OrderDate, '%Y-%m') AS order_month, COUNT(*) AS order_count FROM `order` GROUP BY order_month";
$result_orders = $conn->query($sql_orders);

if (!$result_orders) {
    die("Error executing query: " . $conn->error);
}

$order_labels = [];
$order_counts = [];

if ($result_orders->num_rows > 0) {
    while($row_orders = $result_orders->fetch_assoc()) {
        $order_labels[] = $row_orders['order_month'];
        $order_counts[] = $row_orders['order_count'];
    }
} else {
    echo "0 results";
}

// Convert PHP arrays to JSON for use in JavaScript
$labels_json = json_encode($labels);
$counts_json = json_encode($counts);
$order_labels_json = json_encode($order_labels);
$order_counts_json = json_encode($order_counts);

$conn->close(); // Close the database connection
?>



