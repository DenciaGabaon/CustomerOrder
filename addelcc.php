<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo $_POST['dropdownValuecd'];
    if ($_POST['dropdownValue'] === "add" or $_POST['dropdownValuecd'] === "add") {
        $input1 = $_POST['input1cc'];
        $input2 = $_POST['input2cc'];
        $input3 = $_POST['input3cc'];
        
        // Add record to customer table
        $query = "INSERT INTO `customer` (`FirstName`, `LastName`, `Email`) 
                  VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $input1, $input2, $input3);
        $result = $stmt->execute();
    
        if ($result) {
        } else {
            echo "Error: " . $conn->error;
        }
        
        $stmt->close();
    } elseif ($_POST['dropdownValuecd'] === "delete" or $_POST['dropdownValue'] === "delete") {
        echo "delete";
        $input4 = $_POST['idcc'];
        $input5 = $_POST['input1ccd'];
        $input6 = $_POST['input2ccd'];
        $input7 = $_POST['input3ccd'];
        
        // Delete record from customer table
        $query = "DELETE FROM `customer` WHERE `CustomerID` = ? AND `FirstName` = ? AND `LastName` = ? AND `Email` = ?";
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
    echo "Error: You are not authorized to access this page";
    header("Location: CustomerOrder.php");
    exit;
}
?>
