<?php
session_start(); // Start the session
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['input1cc'];
    $lname = $_POST['input2cc'];
    $email = $_POST['input3cc'];
    $pass = $_POST['input4cc'];
    $repass = $_POST['input5cc'];

    if ($pass != $repass) {
        $_SESSION['error'] = "Error: Passwords do not match"; // Set the session variable
        echo "error"; // Signal to the client-side that there was an error
        exit;
    }

    // Add record to customer table
    $query = "INSERT INTO `customer` (`FirstName`, `LastName`, `Email`) 
              VALUES (?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $fname, $lname, $email);
    $result = $stmt->execute();
    
    if ($result) {
        // Retrieve the CustomerID of the newly inserted record
        $customer_id = $stmt->insert_id;
        
        // Insert record into users table
        $query2 = "INSERT INTO `users` (`CustomerID`, `Email`, `UserPass`) 
                   VALUES (?, ?, ?)";
        
        $stmt2 = $conn->prepare($query2);
        // $hashed_password = password_hash($pass, PASSWORD_DEFAULT); // Hash the password before storing
        
        $stmt2->bind_param("iss", $customer_id, $email, $pass);
        $result2 = $stmt2->execute();
        
        if ($result2) {
            // Successfully inserted into users table
            echo "<script>alert('Registration successful | Go back to login');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
        
        $stmt2->close();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
    
    $stmt->close();
}
?>
