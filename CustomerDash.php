<?php 
include 'db.php'; // Include your database connection file


$customer_info = [];

if (isset($_GET['CustomerID'])) {
    $CustomerID = intval($_GET['CustomerID']);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT CustomerID, FirstName, LastName, Email FROM customer WHERE CustomerID = ?");
    $stmt->bind_param("i", $CustomerID);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the customer data
            $customer = $result->fetch_assoc();
            $customer_info = [
                'CustomerID' => $customer['CustomerID'],
                'CustomerFirstName' => $customer['FirstName'],
                'CustomerName' => $customer['FirstName'] . ' ' . $customer['LastName'],
                'Email' => $customer['Email']
            ];
        } else {
            // No customer found with the given ID
            $customer_info = ['error' => "No customer found with ID $CustomerID"];
        }

    } else {
        // Error executing query
        $customer_info = ['error' => 'Error executing query'];
    }

} else {
    // CustomerID not set
    $customer_info = ['error' => 'CustomerID not set'];
}









// Query to get the number of products per category - NOT DONE
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





// Prepare SQL query to fetch total purchase amount per month for the given Customer ID
$sql1 = "SELECT DATE_FORMAT(OrderDate, '%Y-%m') AS Month, SUM(TotalAmount) AS TotalPurchase 
        FROM orders 
        WHERE CustomerID = ? 
        GROUP BY DATE_FORMAT(OrderDate, '%Y-%m')";

// Prepare and execute the query
$stmt = $conn->prepare($sql1);
$stmt->bind_param('i', $CustomerID);
$stmt->execute();
$result = $stmt->get_result();

$total_purchase_month = [];
$total_purchase = [];

// Fetch and process the results
while ($row = $result->fetch_assoc()) {
    $total_purchase_month[] = $row['Month']; // Month-Year format
    $total_purchase[] = $row['TotalPurchase'];
}















// Query to get the total orders per month based on the CustomerID
$sql_orders = "SELECT DATE_FORMAT(OrderDate, '%Y-%m') AS order_month, 
                      COUNT(OrderID) AS total_orders
               FROM `orders`
               WHERE CustomerID = ?
               GROUP BY order_month";

// Prepare and execute the query
$stmt = $conn->prepare($sql_orders);
$stmt->bind_param('i', $CustomerID);
$stmt->execute();
$result_orders = $stmt->get_result();

$order_labels = [];
$total_orders = [];

// Fetch and process the results
if ($result_orders) {
    if ($result_orders->num_rows > 0) {
        while ($row_orders = $result_orders->fetch_assoc()) {
            $order_labels[] = $row_orders['order_month'];
            $total_orders[] = $row_orders['total_orders'];
        }
    } else {
        echo "0 results";
    }
} else {
    die("Error executing query: " . $conn->error);
}




// Query to get all orders based on the CustomerID
$sql_all_orders = "SELECT OrderID, OrderDate, TotalAmount 
                   FROM `orders` 
                   WHERE CustomerID = ?";

// Prepare and execute the query
$stmt = $conn->prepare($sql_all_orders);
$stmt->bind_param('i', $CustomerID);
$stmt->execute();
$result_all_orders = $stmt->get_result();

$all_customer_orders = [];

// Fetch and process the results
if ($result_all_orders) {
    if ($result_all_orders->num_rows > 0) {
        while ($row_all_orders = $result_all_orders->fetch_assoc()) {
            $all_customer_orders[] = $row_all_orders;
        }
    } else {
    }
} else {
    die("Error executing query: " . $conn->error);
}







// Convert PHP arrays to JSON for use in JavaScript
$customer_info_json = json_encode($customer_info);
$labels_json = json_encode($labels);
$counts_json = json_encode($counts);
$total_purchase_month_json = json_encode($total_purchase_month);
$total_purchase_json = json_encode($total_purchase);
$order_labels_json = json_encode($order_labels);
$total_orders_json = json_encode($total_orders);
$order_list =  json_encode($all_customer_orders); // Output the current month's orders data as JSON

$conn->close(); // Close the database connection
?>



