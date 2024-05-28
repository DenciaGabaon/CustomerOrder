<?php
include 'db.php';

if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];
    $sql = "SELECT CustomerID, OrderDate, TotalAmount FROM `order` WHERE OrderID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        echo json_encode($order);
    } else {
        // No order found with the provided orderId
        echo json_encode(array('error' => 'Order not found'));
    }
} else {
    // No orderId provided in the request
    echo json_encode(array('error' => 'No orderId provided'));
}
?>
