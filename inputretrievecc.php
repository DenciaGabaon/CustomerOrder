<?php
include 'db.php';

if (isset($_GET['customerId'])) {
    $customerId = $_GET['customerId'];
    $sql = "SELECT FirstName, LastName, Email FROM customer WHERE CustomerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $customer = $result->fetch_assoc();
        echo json_encode($customer);
    } else {
        echo json_encode(array());
    }
}
?>
