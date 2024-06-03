<?php

include 'db.php';

unset($uname); 
unset($upass); 

if (isset($_POST['login'])) {
    $Email = $_POST['user'];
    $UserPass = $_POST['pass'];
    $sql = "SELECT * FROM users WHERE Email = ? AND UserPass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $Email, $UserPass);
    $stmt->execute();
    $stmt->store_result(); // Store the result set
    $stmt->bind_result($CustomerID, $Email, $UserPass);
    if ($stmt->fetch()) {
        error_log("Login successful, ". $Email);
        if ($Email == 'gocart@admin1234'){
            $data = $Email;
            header("Location: CustomerOrder.php?data=".urlencode($data));
            exit();
        } else {
            // Close the previous statement before preparing the next one
            $stmt->close();

            // Query the database to fetch the CustomerID associated with the provided email
            $stmt2 = $conn->prepare("SELECT CustomerID FROM users WHERE Email = ?");
            $stmt2->bind_param("s", $Email);

            if ($stmt2->execute()) {
                $result = $stmt2->get_result();
                if ($result->num_rows > 0) {
                    // Fetch the CustomerID
                    $row = $result->fetch_assoc();
                    $CustomerID = $row['CustomerID'];

                    // Redirect to Customerdashboard.php with the email and CustomerID as query parameters
                    $data = $Email;
                    header("Location: Customerdashboard.php?data=".urlencode($data)."&CustomerID=".$CustomerID);
                    unset($Email); 
                    unset($UserPass);         
                    exit; // Make sure to exit to prevent further execution of PHP code
                } else {
                    // Email not found in the database
                    echo "Email not found.";
                }
            } else {
                // Error executing the SQL statement
                echo "Error executing query: " . $stmt2->error;
            }
            $stmt2->close(); // Close the second statement
        }
    } else {
        unset($Email);
        unset($UserPass);
        echo "<script>
                alert('Login Failed');
                 window.location.href = 'Home.php';
            </script>";
        exit();
    }
    
    $stmt->close(); // Close the first statement
}
?>
