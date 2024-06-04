<?php
    include 'db.php';

    header('Content-Type: application/json');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $data = json_decode(file_get_contents('php://input'), true);
    $CustomerID = $data['customerId'];
    $FirstName = $data['firstname'];
    $LastName = $data['lastname'];
    $Email = $data['email'];
    error_log($CustomerID);
    error_log($FirstName);


    $query = "UPDATE `customer` SET `FirstName`= ?,`LastName`= ?,`Email`= ? WHERE `CustomerID`=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssd', $FirstName, $LastName, $Email, $CustomerID);
    $stmt->execute();
    

    echo json_encode(['status' => 'success']);
?>