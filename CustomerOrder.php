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
                        showNotification("AJAX request failed. Status: " + status + ", Error: " + error);
                        console.error("AJAX request failed.");
                        console.error("Status:", status);
                        console.error("Error:", error);
                    }
                });
            });
        });






        </script>

</body>
</html>