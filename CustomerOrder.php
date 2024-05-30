<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Order</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CustomerOrder.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Paytone+One&family=Pixelify+Sans:wght@400..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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

        <div class="content">

           <div class="Customer">
                <h1>Customer's Information</h1>
                <div class= "cc">
                <select id="dropdowncc" name="dropdowncc" required>
                        <option value="">Select</option>
                        <option value="add">Add Record</option>
                        <option value="delete">Delete Record</option>
                    </select>
                <form id="mainFormcc" action="" method="post">     
                    <input type="hidden" id="dropdownValue" name="dropdownValue">
                    <input type="text" id="input1cc" name="input1cc" placeholder="First Name" required>
                    <input type="text" id="input2cc" name="input2cc" placeholder="Last Name" required>
                    <input type="text" id="input3cc" name="input3cc" placeholder="Email" required>
                    <button type="submit">Submit</button>
                </form>


                <form id="delform" action="" method="post">
                    <input type="hidden" id="dropdownValuecd" name="dropdownValuecd">
                    <div class= "del"> 
                    <select id="idcc" name="idcc" onchange="loadCustomerDetails(this.value)" required>
                        <option value="" selected>ID</option>
                        <?php
                        $sql = "SELECT DISTINCT CustomerID FROM customer";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['CustomerID'] . "'>" . $row['CustomerID'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="text" id="input1ccd" name="input1ccd" placeholder="First Name" required>
                    </div>
                    <input type="text" id="input2ccd" name="input2ccd" placeholder="Last Name" required>
                    <input type="text" id="input3ccd" name="input3ccd" placeholder="Email" required>
                    <button type="submit">Submit</button>

                </form>
                </div>
           </div>






           <div class="Order">
           <h1>Order Form</h1>
           <div class = "oo">
           <select id="dropdownoo" name="dropdownoo" required>
                        <option value="">Select</option>
                        <option value="add">Add Order</option>
                        <option value="delete">Delete Order</option>
                    </select>

           <form id="mainFormoo" action="" method="post">
                    <input type="hidden" id="dropdownValueo" name="dropdownValueo">
                    <select id="customerid" name="customerid" required>
                        <option value="" selected>CustomerID</option>
                        <?php
                            $sql = "SELECT DISTINCT CustomerID FROM customer";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['CustomerID'] . "'>" . $row['CustomerID'] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    <input type="text" id="input2oo" name="input2oo" placeholder="Date" required>
                    <input type="text" id="input3oo" name="input3oo" placeholder="Total " required>
                    <button type="submit">Submit</button>
                </form>

                <form id="delformoo" action="" method="post">
                    <div class= "deloo"> 
                    <input type="hidden" id="dropdownValueod" name="dropdownValueod">
                    <select id="idoo" name="idoo" onchange="loadOrderDetails(this.value)"required>
                        <option value="" selected>ID</option>
                        <?php
                            $sql = "SELECT DISTINCT OrderID FROM `order` ORDER BY OrderID ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['OrderID'] . "'>" . $row['OrderID'] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    <input type="text" id="input1ood" name="input1ood" placeholder="CustomerID" required>
                    </div>
                    <input type="text" id="input2ood" name="input2ood" placeholder="Date" required>
                    <input type="text" id="input3ood" name="input3ood" placeholder="Total" required>
                    <button type="submit">Submit</button>

                </form>
           </div>
           </div>
        </div>
    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>
    <script>
            // Prevent the default form submission behavior
        document.getElementById("mainFormcc").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get form data
            var formData = new FormData(this);

            // Send form data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "addelcc.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle the response here
                        alert('Record Added to customer table');
                    } else {
                        // Handle errors if any
                        alert('Error: ' + xhr.responseText);
                    }
                }
            };
            xhr.send(formData); // Send form data
        });


        document.getElementById("delform").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get form data
            var formData = new FormData(this);

            // Send form data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "addelcc.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle the response here
                        alert('Record deleted from customer table');
                    } else {
                        // Handle errors if any
                        alert('Error: ' + xhr.responseText);
                    }
                }
            };
            xhr.send(formData); // Send form data
        });


        document.getElementById("mainFormoo").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get form data
            var formData = new FormData(this);

            // Send form data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "addeloo.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle the response here
                        alert('Record Added to order table');
                    } else {
                        // Handle errors if any
                        alert('Error: ' + xhr.responseText);
                    }
                }
            };
            xhr.send(formData); // Send form data
        });


        document.getElementById("delformoo").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get form data
            var formData = new FormData(this);

            // Send form data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "addeloo.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle the response here
                        alert('Record deleted from order table');
                    } else {
                        // Handle errors if any
                        alert('Error: ' + xhr.responseText);
                    }
                }
            };
            xhr.send(formData); // Send form data
        });



        function setCurrentDate(inputId) {
            var input = document.getElementById(inputId);
            var today = new Date().toISOString().split('T')[0]; // Get current date in YYYY-MM-DD format
            input.value = today;
        }
        setCurrentDate("input2oo");

        // Get the dropdown element
        var dropdown = document.getElementById("dropdowncc");

        // Get the forms
        var addForm = document.getElementById("mainFormcc");
        var deleteForm = document.getElementById("delform");

        // Add event listener to the dropdown
        dropdown.addEventListener("change", function() {
            // Check the selected value
            if (dropdown.value === "add") {
                // Show add form and hide delete form
                addForm.style.display = "flex";
                deleteForm.style.display = "none";
            } else if (dropdown.value === "delete") {
                // Show delete form and hide add form
                addForm.style.display = "none";
                deleteForm.style.display = "flex";
            }
        });

        var dropdown1 = document.getElementById("dropdownoo");

        // Get the forms
        var addFormoo = document.getElementById("mainFormoo");
        var deleteFormoo = document.getElementById("delformoo");

        // Add event listener to the dropdown
        dropdown1.addEventListener("change", function() {
            // Check the selected value
            if (dropdown1.value === "add") {
                // Show add form and hide delete form
                addFormoo.style.display = "flex";
                deleteFormoo.style.display = "none";
            } else if (dropdown1.value === "delete") {
                // Show delete form and hide add form
                addFormoo.style.display = "none";
                deleteFormoo.style.display = "flex";
            }
        });
        

        function loadCustomerDetails(customerId) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "inputretrievecc.php?customerId=" + customerId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var customer = JSON.parse(xhr.responseText);
                        console.log(customer);
                        if (customer) {
                            document.getElementById("input1ccd").value = customer.FirstName;
                            document.getElementById("input2ccd").value = customer.LastName;
                            document.getElementById("input3ccd").value = customer.Email;
                        } else {
                            console.error("No customer data found");
                        }
                    } else {
                        console.error("Error fetching customer data: " + xhr.status);
                    }
                }
            };
            xhr.send();
        }


        function loadOrderDetails(orderId) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "orderretrieve.php?orderId=" + orderId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var order = JSON.parse(xhr.responseText);
                        console.log(order);
                        if (order) {
                            document.getElementById("input1ood").value = order.CustomerID;
                            document.getElementById("input2ood").value = order.OrderDate;
                            document.getElementById("input3ood").value = order.TotalAmount;
                        } else {
                            console.error("No customer data found");
                        }
                    } else {
                        console.error("Error fetching customer data: " + xhr.status);
                    }
                }
            };
            xhr.send();
        }


        console.log("Script loaded successfully."); // Add this line to check if script execution is happening
            document.getElementById("dropdowncc").addEventListener("change", function() {
                console.log("Selected value of dropdowncc:", this.value);
                // Set the value of the hidden input field to the selected value of the dropdown
                document.getElementById("dropdownValue").value = this.value;
                document.getElementById("dropdownValuecd").value = this.value;
                console.log("Value of dropdownValue:", document.getElementById("dropdownValue").value);
            });


            document.getElementById("dropdownoo").addEventListener("change", function() {
                console.log("Selected value of dropdownoo:", this.value);
                // Set the value of the hidden input field to the selected value of the dropdown
                document.getElementById("dropdownValueo").value = this.value;
                document.getElementById("dropdownValueod").value = this.value;
                console.log("Value of dropdownValueo:", document.getElementById("dropdownValueo").value);
            });

           
        </script>

</body>
</html>