<?php
include 'db.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerID = $_POST['customerid'];
    $orderDate = $_POST['input1oo'];
    $productData = json_decode($_POST['product_data'], true);
    $totalAmount = $_POST['total_amount'];

    // Insert the order into the orders table
    $sql = "INSERT INTO orders (CustomerID, OrderDate, TotalAmount) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $customerID, $orderDate, $totalAmount);

    if ($stmt->execute()) {
        $orderID = $stmt->insert_id;
        echo "Order ID: " . $orderID . "<br>";
        echo "Product Data:<br>";
        foreach ($productData as $product) {
            echo "Product ID: " . $product['id'] . "<br>";
            echo "Product Name: " . $product['name'] . "<br>";
            echo "Price: " . $product['price'] . "<br><br>";
            // Insert each product into the order_products table
            $sql = "INSERT INTO order_products (OrderID, ProductID, ProductName, Price) VALUES (?, ?, ?, ?)";
            $stmtProduct = $conn->prepare($sql);
            $stmtProduct->bind_param("issd", $orderID, $product['id'], $product['name'], $product['price']);
            $stmtProduct->execute();
            $stmtProduct->close();
        }

        echo "<script>alert('Order placed successfully.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

?>
