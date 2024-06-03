<?php 
include 'db.php'; // Include your database connection file

// Query to get the number of products per category with category names
$sql = "SELECT c.CategoryName, COUNT(p.ProductID) AS ProductCount
        FROM product p
        JOIN category c ON p.CategoryID = c.CategoryID
        GROUP BY c.CategoryName";

$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

$labels = [];
$counts = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $labels[] = $row['CategoryName'];
        $counts[] = $row['ProductCount'];
    }
} else {
    echo "0 results";
}






// Query to get the summary of orders over time (example: by month)
$sql_orders = "SELECT DATE_FORMAT(OrderDate, '%Y-%m') AS order_month, COUNT(*) AS order_count FROM `orders` GROUP BY order_month";
$result_orders = $conn->query($sql_orders);

if (!$result_orders) {
    die("Error executing query: " . $conn->error);
}

$order_labels = [];
$order_counts = [];

// $response = array(
//     'total' => 0,
//     'name' => 'Order',
//     'success'=> true
// );

// echo json_encode($response);

if ($result_orders->num_rows > 0) {
    while($row_orders = $result_orders->fetch_assoc()) {
        $order_labels[] = $row_orders['order_month'];
        $order_counts[] = $row_orders['order_count'];
    }
} else {
    echo "0 results";
}



// Query to get the summary of orders over time (example: by month)
$sql_orders = "SELECT DATE_FORMAT(OrderDate, '%Y-%m') AS order_month, 
                      COUNT(OrderID) AS total_accounts,
                      SUM(TotalAmount) AS total_revenue
               FROM `orders` 
               GROUP BY order_month";
$result_orders = $conn->query($sql_orders);

if (!$result_orders) {
    die("Error executing query: " . $conn->error);
}

$order_labels1 = [];
$total_accounts = [];
$total_revenue = [];
$total_profit = [];

if ($result_orders->num_rows > 0) {
    while ($row_orders = $result_orders->fetch_assoc()) {
        $order_labels1[] = $row_orders['order_month'];
        $total_accounts[] = $row_orders['total_accounts'];
        $total_revenue[] = $row_orders['total_revenue'];
        $total_profit[] = $row_orders['total_revenue'] * 0.2; // Assuming profit is 20% of revenue
    }
} else {
    echo "0 results";
}


// Query to get the summary of orders for the current month
$sql_current_month = "SELECT 
                      COUNT(OrderID) AS total_accounts,
                      SUM(TotalAmount) AS total_revenue
               FROM `orders` 
               WHERE YEAR(OrderDate) = YEAR(CURRENT_DATE()) AND MONTH(OrderDate) = MONTH(CURRENT_DATE())";

$result_current_month = $conn->query($sql_current_month);

if (!$result_current_month) {
    die("Error executing query: " . $conn->error);
}

$total_sales_current_month = 0;
$total_revenue_current_month = 0;
$total_profit_current_month = 0;

if ($result_current_month->num_rows > 0) {
    $row_current_month = $result_current_month->fetch_assoc();
    $total_sales_current_month = $row_current_month['total_accounts'];
    $total_revenue_current_month = $row_current_month['total_revenue'];
    $total_profit_current_month = $row_current_month['total_revenue'] * 0.2; // Assuming profit is 20% of revenue
} else {
    echo "0 results for current month";
}


// Query to get the summary of orders for the current month
$sql_current_month_orders = "SELECT OrderID, CustomerID, TotalAmount FROM `orders` WHERE YEAR(OrderDate) = YEAR(CURRENT_DATE()) AND MONTH(OrderDate) = MONTH(CURRENT_DATE())";
$result_current_month_orders = $conn->query($sql_current_month_orders);

if (!$result_current_month_orders) {
    die("Error executing query: " . $conn->error);
}

$current_month_orders = [];

if ($result_current_month_orders->num_rows > 0) {
    while ($row_current_month_orders = $result_current_month_orders->fetch_assoc()) {
        $current_month_orders[] = $row_current_month_orders;
    }
} else {
}







// Convert PHP arrays to JSON for use in JavaScript
$labels_json = json_encode($labels);
$counts_json = json_encode($counts);
$order_labels_json = json_encode($order_labels);
$order_counts_json = json_encode($order_counts);
$order1_labels_json = json_encode($order_labels1);
$total_sales_json = json_encode($total_accounts);
$total_revenue_json = json_encode($total_revenue);
$total_profit_json = json_encode($total_profit);

// Convert PHP variables to JSON for use in JavaScript
$total_sales_current_month_json = json_encode($total_sales_current_month);
$total_revenue_current_month_json = json_encode($total_revenue_current_month);
$total_profit_current_month_json = json_encode($total_profit_current_month);
$order_list =  json_encode($current_month_orders); // Output the current month's orders data as JSON


$conn->close(); // Close the database connection
?>



