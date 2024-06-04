<?php
include 'db.php';

$dropdown1 = $_POST['dropdown1'];
$dropdown2 = $_POST['dropdown2'];

// Define header names based on dropdown selection
if ($dropdown1 == 'category') {
    // Query to retrieve product details including category name based on the selected category
    $query = "SELECT c.CategoryID, p.ProductID, p.ProductName, p.Price 
              FROM product p
              INNER JOIN category c ON p.CategoryID = c.CategoryID 
              WHERE c.CategoryID = ?";
    $headers = array("CategoryID", "ProductID", "ProductName", "Price");
} else {
    // If dropdown1 is not 'category', handle it accordingly (for example, retrieving customer-related data)
    $query = "SELECT c.CustomerID, c.FirstName, c.LastName, o.OrderID, o.TotalAmount, o.OrderDate 
          FROM `orders` o
          INNER JOIN customer c ON o.CustomerID = c.CustomerID 
          WHERE o.CustomerID = ?";
    $headers = array("CustomerID", "FirstName", "LastName", "OrderID", "TotalAmount", "OrderDate");
}

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $dropdown2);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table>";
    
    // Print table headers
    echo "<thead><tr>";
    foreach ($headers as $header) {
        echo "<th>$header</th>";
    }
    echo "</tr></thead>";

    // Print data rows
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "No records found.";
}

$stmt->close();
$conn->close();
?>
