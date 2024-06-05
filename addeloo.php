<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {   

    if ($_POST['dropdownValueo'] === "delete" || $_POST['dropdownValueod'] === "delete") {
        $orderID = $_POST['orderid'];
        error_log("order: ". $orderID);
        $customerID = $_POST['customerid'];
        error_log("customerid:". $customerID);
        $orderDate = $_POST['input1dd'];
        error_log("orderdate:" .$orderDate);
        $totalAmount = $_POST['input4dd'];
        error_log("total: ". $totalAmount);
        
        // Delete records from order_products table
        $query = "DELETE FROM `order_products` WHERE `OrderID` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $orderID); // Assuming OrderID is an integer
        
        if ($stmt->execute()) {
            // Delete record from orders table
            $query = "DELETE FROM `orders` WHERE `OrderID` = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $orderID); // Adjust types if necessary
            
            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Order deleted successfully."]);
            } else {
                echo json_encode(["success" => false, "message" => "Error deleting order: " . $stmt->error]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Error deleting order products: " . $stmt->error]);
        }
        
        $stmt->close();
        $conn->close();
    } else {
        // Redirect or display an error message if accessed directly
        header("Location: CustomerOrder.php");
        exit;
    }
}
?>
