<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   

    if ($_POST['dropdownValueo'] === "add" or $_POST['dropdownValueod'] === "add") {
        // Add record to customer table
        $input1 = $_POST['customerid'];
        $input2 = $_POST['input2oo'];
        $input3 = $_POST['input3oo'];
        $query = "INSERT INTO `order` (`CustomerID`, `OrderDate`, `TotalAmount`) 
                  VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $input1, $input2, $input3);
        $result = $stmt->execute();

        if ($result) {
        } else {
            echo "Error: " . $conn->error;
        }
        
        $stmt->close();
    } elseif ($_POST['dropdownValueod'] === "delete" or $_POST['dropdownValueo'] === "delete") {
        echo "delete";
        $input4 = $_POST['idoo'];
        $input5 = $_POST['input1ood'];
        $input6 = $_POST['input2ood'];
        $input7 = $_POST['input3ood'];
        
        // Delete record from customer table
        $query = "DELETE FROM `order` WHERE `OrderID` = ? AND `CustomerID` = ? AND `OrderDate` = ? AND `TotalAmount` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $input4, $input5, $input6, $input7); // Assuming CustomerID is a string, adjust if necessary
        $result = $stmt->execute();
        echo $result;
    
        if ($result) {
        } else {
            echo "Error: " . $conn->error;
        }
        
        $stmt->close();
    }
} else {
    // Redirect or display an error message if accessed directly
    header("Location: CustomerOrder.php");
    exit;
}
?>
