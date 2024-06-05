<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['dropdownValueo'] === "add" || $_POST['dropdownValueod'] === "add") {

        $customerID = $_POST['customerid'];
        $orderDate = $_POST['input1oo'];
        $productData = json_decode($_POST['product_data'], true);

        
        if (json_last_error() !== JSON_ERROR_NONE) {
            die('Error decoding JSON: ' . json_last_error_msg());
        }

        if (!is_array($productData)) {
            die('product_data is not an array');
        }

        // Calculate total amount based on the prices of the ordered products
        $totalAmount = 0;
        foreach ($productData as $product) {
            $totalAmount += $product['price'];
        }

        // Insert the order into the orders table
        $sql = "INSERT INTO orders (CustomerID, OrderDate, TotalAmount) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("ssd", $customerID, $orderDate, $totalAmount);

        if ($stmt->execute()) {
            $orderID = $stmt->insert_id;
            foreach ($productData as $product) {
                // Insert each product into the order_products table
                $sql = "INSERT INTO order_products (OrderID, ProductID, ProductName, Price) VALUES (?, ?, ?, ?)";
                $stmtProduct = $conn->prepare($sql);
                $stmtProduct->bind_param("issd", $orderID, $product['id'], $product['name'], $product['price']);
                $stmtProduct->execute();
                $stmtProduct->close();
            }
            // Return JSON response
            echo json_encode(array("success" => true, "orderID" => $orderID));
        } else {
            // Return JSON response
            echo json_encode(array("success" => false, "error" => "Error: " . $stmt->error));
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
