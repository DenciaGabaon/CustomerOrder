<?php
include 'db.php';
include 'AddFormretrieve.php';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

           <h1>Order Form</h1>

           <div class="Order">
                <div class = "oo">
                    <select id="dropdownoo" name="dropdownoo" required>
                        <option value="">Select</option>
                        <option value="add">Add Order</option>
                        <option value="delete">Delete Order</option>
                    </select>

                    <form id="mainFormoo"  method="post">
                        <div class="aa">
                            <div class="bb">
                                <input type="hidden" id="dropdownValueo" name="dropdownValueo">
                                <div class="row_input">
                                    <select id="customerid" name="customerid" required>
                                        <option value="" selected>CustomerID</option>
                                        <?php
                                            $sql = "SELECT DISTINCT CustomerID FROM customer ORDER BY CustomerID";
                                            $result = $conn->query($sql);
                                            
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['CustomerID'] . "'>" . $row['CustomerID'] . "</option>";
                                                }
                                            }
                                            
                                        ?>
                                    </select>
                                    <input type="text" id="input1oo" name="input1oo" placeholder="Date" required>
                                </div>
                                <div class="add_product">
                                    <div class="row_input">
                                        <select id="input2oo" name="input2oo" >
                                            <option value="" selected>Select Product</option>
                                            <?php
                                                $sql = "SELECT ProductID, ProductName, Price FROM product";
                                                $result = $conn->query($sql);

                                                if (!$result) {
                                                    die("Error executing query: " . $conn->error);
                                                }

                                                $product_options = "";

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $product_options .= '<option value="' . $row['ProductID'] . '" data-price="' . $row['Price'] . '">' . $row['ProductName'] . '</option>';
                                                    }
                                                } else {
                                                    $product_options = '<option value="">No products available</option>';
                                                }

                                                echo $product_options;
                                            ?>
                                        </select>
                                        <input type="text" id="input3oo" name="input3oo" placeholder="ID" disabled>
                                    </div>
                                    <div class="row_input">
                                        <input type="text" id="input4oo" name="input4oo" placeholder="Total" disabled>
                                        <button type="button" id="input5oo" onclick="displayFormData()">+</button>
                                    </div>
                                </div>
                                <input type="hidden" id="product_data" name="product_data">
                                <input type="hidden" id="total_amount" name="total_amount">
                                <button type="submit" id="sb">Submit</button>
                            </div>
                        </div>
                    </form>


                    <form id="delform"  method="post">
                        <div class="xx">
                            <div class="yy">
                                <input type="hidden" id="dropdownValueod" name="dropdownValueod">
                                <div class="row_input">
                                    <select id="orderid" name="orderid" onchange="loadCustomerDetails(this.value)" required>
                                        <option value="" selected>OrderID</option>
                                        <?php
                                            $sql = "SELECT DISTINCT OrderID FROM orders ORDER BY OrderID";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['OrderID'] . "'>" . $row['OrderID'] . "</option>";
                                                }
                                            }
                                            
                                        ?>
                                    </select>
                                    <input type="text" id="input1dd" name="input1dd" placeholder="Date" disabled>
                                </div>
                                <div class="add_productdd">
                                        <input type="text" id="input3dd" name="input3dd" placeholder="CustomerID" disabled>
                                        <input type="text" id="input4dd" name="input4dd" placeholder="Total" disabled>
                                </div>
                                <input type="hidden" id="product_data" name="product_data">
                                <input type="hidden" id="total_amount" name="total_amount">
                                <button type="submit" id="sub">Submit</button>
                            </div>
                        </div>
                    </form>


                </div>
                <div class = "receipt_base">
                    <div class = "receipt">
                        <div class= "logo_receipt">
                            <img src="asset\logo.png" alt="logo">
                        </div>
                        <div class= "receipt_content" id= "receipt_content">
                            <div class= "receipt_header" id= "receipt_header">
                            </div>
                            <div class= "receipt_body" id= "receipt_body">
                            </div>
                            <div class= "receipt_footer" id= "receipt_footer">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div id="centered-notification" class="centered-notification">
                <div class="notification-content">
                    <p id="notification-message"></p>
                    <button onclick="closeNotification()">Close</button>
                </div>
            </div>
        </div>
    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>
    <script>

       
       function setCurrentDate(inputId) {
            var input = document.getElementById(inputId);
            var today = new Date().toISOString().split('T')[0]; // Get current date in YYYY-MM-DD format
            input.value = today;
        }
        setCurrentDate("input1oo");


        document.getElementById('input2oo').addEventListener('change', function () {
            var selectedProductId = this.value;
            document.getElementById('input3oo').value = selectedProductId;
        });

        var total = 0; // Variable to keep track of the total
        var productList = []; // Array to store product details

        function displayFormData() {
            var customerID = document.getElementById('customerid').value;
            var Dates = document.getElementById('input1oo').value;
            var productID = document.getElementById('input2oo').value;
            var productName = document.querySelector('#input2oo option:checked').textContent;
            var price = parseFloat(document.querySelector('#input2oo option:checked').dataset.price);

            total += price; // Add the price to the total
            document.getElementById('input4oo').value = total.toFixed(2); // Update the total field

            productList.push({
                id: productID,
                name: productName,
                price: price
            }); // Add product details to the array

            var formData = {
                customerid: customerID,
                Date: Dates,
                price: price,
                product_data: JSON.stringify(productList)
            };

            console.log(formData);

            // AJAX call to retrieve the OrderID
            $.ajax({
                url: 'GetId.php', // Replace with the path to your PHP script
                type: 'POST',
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    if (response.lastOrderID !== undefined) {
                        let orderID = parseInt(response.lastOrderID) + 1;
                        var content_header = "OrderID: " + orderID + "<br>";
                        content_header += "CustomerID: " + customerID + "<br>"; // Add OrderID to the receipt header
                        content_header += "Date: " + Dates + "<br>";
                        document.getElementById('receipt_header').innerHTML = content_header;
                    } else {
                        console.error(response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + error);
                }
            });



            var content_header = "CustomerID: " + customerID + "<br>";
            content_header += "Date: " + Dates + "<br>";
            document.getElementById('receipt_header').innerHTML = content_header;

            var content_body = '<div class="product-details">';
            content_body += '<span class="product-id">' + productID + '</span>';
            content_body += '<span class="product-name">' + productName + '</span>';
            content_body += '<span class="product-price">' + price.toFixed(2) + '</span>';
            content_body += '</div>';
            document.getElementById('receipt_body').innerHTML += content_body; // Append the new product to the receipt body

            var content_footer = "Total: " + total.toFixed(2);
            document.getElementById('receipt_footer').innerHTML = content_footer;

            // Reset the product dropdown to its default option and clear the product ID input
            document.getElementById('input2oo').value = "";
            document.getElementById('input3oo').value = "";

            document.getElementById('product_data').value = JSON.stringify(productList); // Store product details as JSON string
        }

        // document.getElementById('mainFormoo').addEventListener('submit', function(event) {
        //     var productDataField = document.getElementById('product_data');
        //     var totalAmountField = document.getElementById('total_amount');
            
            
        //     // Serialize the product list to JSON
        //     productDataField.value = JSON.stringify(productList);
        //     totalAmountField.value = total.toFixed(2);
        // });

        
        // $(document).ready(function () {
        //     $("#mainFormoo").submit(function (event) {
        //         event.preventDefault(); // Prevent the default form submission

        //         var formData = $(this).serialize(); // Serialize the form data

        //         $.ajax({
        //             type: "POST",
        //             url: "AddFormretrieve.php",
        //             data: formData,
        //             dataType: "json",
        //             success: function (response) {
        //                 if (response.success) {
        //                     alert("Order submitted successfully.")
        //                     console.log("Form submitted successfully.");
        //                     console.log("Order ID:", response.orderID);
        //                 } else {
        //                     alert("Order submission failed.")
        //                     console.error("Form submission failed.");
        //                     console.error("Error message:", response.error);
        //                 }
        //             },
        //             error: function (xhr, status, error) {
        //                 console.error("AJAX request failed.");
        //                 console.error("Status:", status);
        //                 console.error("Error:", error);
        //             }
        //         });
        //     });
        // });


        function showNotification(message) {
            var notification = document.getElementById('centered-notification');
            var messageElement = document.getElementById('notification-message');
            messageElement.textContent = message;
            notification.style.display = 'block';
        }

        function closeNotification() {
            var notification = document.getElementById('centered-notification');
            notification.style.display = 'none';
            location.reload();
        }

        $(document).ready(function () {
            $("#mainFormoo").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                var formData = $(this).serialize(); // Serialize the form data

                $.ajax({
                    type: "POST",
                    url: "AddFormretrieve.php",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            showNotification("Order submitted successfully.");
                            console.log("Form submitted successfully.");
                            console.log("Order ID:", response.orderID);
                        } else {
                            showNotification("Order submission failed.");
                            console.error("Form submission failed.");
                            console.error("Error message:", response.error);
                        }
                    },
                    error: function (xhr, status, error) {
                        showNotification("Select Add or Delete Order");
                        console.error("AJAX request failed.");
                        console.error("Status:", status);
                        console.error("Error:", error);
                    }
                });
            });
        });


        var dropdown = document.getElementById("dropdownoo");

        // Get the forms
        var addForm = document.getElementById("mainFormoo");
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



        document.getElementById("dropdownoo").addEventListener("change", function() {
                console.log("Selected value of dropdownoo:", this.value);
                // Set the value of the hidden input field to the selected value of the dropdown
                document.getElementById("dropdownValueo").value = this.value;
                document.getElementById("dropdownValueod").value = this.value;
                console.log("Value of dropdownValueo:", document.getElementById("dropdownValueo").value);
            });


            function loadCustomerDetails(orderid) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "inputretrievecc.php?orderid=" + orderid, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200) {
                            var orders = JSON.parse(xhr.responseText);
                            console.log(orders);
                            if (orders.length > 0) {
                                var order = orders[0]; // Assuming only one order ID is passed
                                document.getElementById("input1dd").value = order.OrderDate;
                                document.getElementById("input3dd").value = order.CustomerID;  //"Customer ID:\t\t\t\t\t" +
                                document.getElementById("input4dd").value = order.TotalAmount;  //"Total:\t\t\t\t\t\t\t" + 

                                var receipt_header = "Order ID: " + order.OrderID + "<br>";
                                receipt_header += "Customer ID: " + order.CustomerID + "<br>";
                                receipt_header += "Order Date: " + order.OrderDate + "<br>";
                                document.getElementById('receipt_header').innerHTML = receipt_header;
                                
                                var receipt_body = document.getElementById("receipt_body");

                                receipt_body.innerHTML = ""; // Clear previous products
                                order.Products.forEach(function(product) {
                                    var productDiv = document.createElement("div");
                                    productDiv.innerHTML = `
                                        <div class="product-details">
                                            <span class="product-id"> ${product.ProductID}</span>
                                            <span class="product-name"> ${product.ProductName}</span>
                                            <span class="product-price"> ${product.Price}</span>
                                        </div>
                                    `;
                                    receipt_body.appendChild(productDiv);
                                });

                                var receipt_footer = "Total: " + order.TotalAmount;
                                document.getElementById('receipt_footer').innerHTML = receipt_footer;
                            } else {
                                console.error("No orders found for this order ID.");
                            }
                        } else {
                            console.error("Error fetching order data: " + xhr.status);
                        }
                    }
                };
                xhr.send();
            }


            document.getElementById("delform").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get form data
            var formData = new FormData(this);
            console.log("Form data:", formData);

            // Send form data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "addeloo.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle the response here
                        showNotification('Record deleted from order table');
                    } else {
                        // Handle errors if any
                        showNotification("Select Add or Delete Order");
                    }
                }
            };
            xhr.send(formData); // Send form data
        });






        </script>

</body>
</html>