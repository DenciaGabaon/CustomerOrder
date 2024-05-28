<?php
include 'db.php'; // Include your database connection file
?>


<!DOCTYPE html>
<html>
<head>
    <title>Customer Order</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="reports.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Paytone+One&family=Pixelify+Sans:wght@400..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>
<body>
        <div class="header">
            <div class= "header1">
                <div class= "logo">
                    <img src="asset\logo.png" alt="logo">
                </div>
                <nav class="nav">
                    <ul>
                        <li><a href="CustomerOrder.php">Forms</a></li>
                        <li><a href="reports.php">Report</a></li>
                        <li><a href="Dashboard.php">Dashboard</a></li>
                    </ul>
                </nav>
                <div class="logout">
                            <a href="Home.php" class="button start">Logout</a>
                </div>
            </div>
            <div class="header_img">
                <img id= "first" src="asset\Group 2.svg" alt="top">
                <img id= "second" src="asset\Group 1.svg" alt="bottom">
            </div>
        </div>

<div class="fills">
    <form id="mainForm">
        <select id="dropdown1" name="dropdown1" required>
            <option value="none">Select</option>
            <option value="category">Category ID</option>
            <option value="customer">Customer ID</option>
        </select>

        <select id="dropdown2" name="dropdown2" required>
        </select>

        <button type="submit">Submit</button>
    </form>
</div>

<div class="content">
    <div class="tablecon" id="dataTable">
        <!-- The retrieved table will be displayed here -->
    </div>
</div>

<footer>
    <p>&copy; 2024 Your Website. All rights reserved.</p>
</footer>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("dropdown1").addEventListener("change", function() {
        var dropdown1Value = this.value;
        var dropdown2 = document.getElementById("dropdown2");
        dropdown2.innerHTML = ""; // Clear existing options

        console.log("Dropdown1 Value: ", dropdown1Value); // Debugging line

        var xhr = new XMLHttpRequest();
        var url = dropdown1Value === "category" ? "Categoriesretrieve.php" : "Customersretrieve.php";
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log("Response Text: ", xhr.responseText); // Debugging line
                var options = JSON.parse(xhr.responseText);
                options.forEach(function(option) {
                    var opt = document.createElement("option");
                    opt.value = option;
                    opt.textContent = option;
                    dropdown2.appendChild(opt);
                });
            }
        };
        xhr.send();
    });

    document.getElementById("mainForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way

        var dropdown1Value = document.getElementById("dropdown1").value;
        var dropdown2Value = document.getElementById("dropdown2").value;
        var xhr = new XMLHttpRequest();
        var url = "retrieve.php";

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("dataTable").innerHTML = xhr.responseText;
            }
        };
        xhr.send("dropdown1=" + dropdown1Value + "&dropdown2=" + dropdown2Value);
    });
});
</script>
</body>
</html>
