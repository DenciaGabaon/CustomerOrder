<?php
include 'db.php';


if (isset($_GET['orderid'])) {
    $orderId = $_GET['orderid'];

    $sql = "SELECT o.OrderID, o.CustomerID, o.OrderDate, o.TotalAmount, op.ProductID, op.ProductName, op.Price
            FROM orders o
            LEFT JOIN order_products op ON o.OrderID = op.OrderID
            WHERE o.OrderID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $orderID = $row['OrderID'];
            if (!isset($orders[$orderID])) {
                $orders[$orderID] = array(
                    'OrderID' => $row['OrderID'],
                    'CustomerID' => $row['CustomerID'],
                    'OrderDate' => $row['OrderDate'],
                    'TotalAmount' => $row['TotalAmount'],
                    'Products' => array()
                );
            }
            $orders[$orderID]['Products'][] = array(
                'ProductID' => $row['ProductID'],
                'ProductName' => $row['ProductName'],
                'Price' => $row['Price']
            );
        }
        echo json_encode(array_values($orders));
    } else {
        echo json_encode(array());
    }
} else {
    echo json_encode(array("error" => "Order ID not provided"));
}
?>
