<?php
$servername = "127.0.0.1";
$database = "customerorders"; // Replace with your actual database name
$username =  "root";
$password = null;
$port = "3307"; // Specify the port number

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>