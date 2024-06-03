<?php

include 'CustomerDash.php'; // Include the file that fetches the data

?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Order</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Customerdashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Paytone+One&family=Pixelify+Sans:wght@400..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="header">
        <div class="header1">
            <div class="logo">
                <img src="asset/logo.png" alt="logo">
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="Dashboard.php">Dashboard</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="Home.php" class="button start">Logout</a>
            </div>
        </div>
        <div class="header_img">
            <img id="first" src="asset/Group 2.svg" alt="top">
            <img id="second" src="asset/Group 1.svg" alt="bottom">
        </div>
    </div>

    <div class="content">
        <div class = "welcome"> 
            <p style="padding-right: 10px;"> Welcome Customer,</p>
            <p id="welcome_name"></p>
            <p>!</p>
        </div>
        <div class = "dashbcontent">
            <div class = "box1">
                <div class = "customer_info">
                    <p id="customerID">Customer ID:</p>
                    <p id="customerName">Customer Name:</p>
                    <p id="customerEmail">Email:</p>
                </div>
                <div class="chart1">
                    <div class="chart1-label">
                        <p>Order Summary Per Category</p>
                    </div>
                    <div class="chart1-data">
                        <canvas id="Chart1"></canvas>
                    </div>
                </div>
            </div>
            <div class = "box2">
                <div class="chart2">
                    <div class="chart2-label">
                        <p>Total Purchase Per Month</p>
                    </div>
                    <div class="chart2-data">
                        <canvas id="Chart2"  width="80" height="20"></canvas>
                    </div>
                </div>
                <div class="chart3">
                    <div class="chart3-label">
                        <p>Total Orders Per Month</p>
                    </div>
                    <div class="chart3-data">
                        <canvas id="Chart3"  width="80" height="20" ></canvas>
                    </div>
                </div>
            </div>
            <div class = "box3">
                <div class="chart4">
                    <div class="chart4-label">
                        <p>Detailed Order list</p>
                    </div>
                    <table id="dataTable" class="tablecon">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>OrderDate</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Order data will be populated dynamically here -->
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        
        // Get data from PHP
        const labels = <?php echo $labels_json; ?>;
        const counts = <?php echo $counts_json; ?>;

        // Create the doughnut chart
        const ctx = document.getElementById('Chart1').getContext('2d');
        const doughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Products per Category',
                    data: counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(199, 199, 199, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            },
        });

         // Get data from PHP for line chart
        var totalPurchaseMonth = <?php echo json_encode($total_purchase_month); ?>;
        var totalPurchase = <?php echo json_encode($total_purchase); ?>;

        



         //line chart
         const ctxLine = document.getElementById('Chart2').getContext('2d');
            const lineChart = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: totalPurchaseMonth, // Ensure orderLabels is defined elsewhere in your script
                    datasets: [
                        {
                            label: 'Total Prchase',
                            data: totalPurchase,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        },
                        
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            });


        var orderLabels = <?php echo json_encode($order_labels); ?>;
        var orderCounts = <?php echo json_encode($total_orders); ?>;


        // Get data from PHP for bar chart (same as line chart data in this example)
        const ctxBar = document.getElementById('Chart3').getContext('2d');
        const barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: orderLabels,
                datasets: [{
                    label: 'Orders per Month',
                    data: orderCounts,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });

        $(document).ready(function() {
            var orderList = <?php echo $order_list; ?>;
            console.log(orderList);
            if (orderList.length > 0) {
                $.each(orderList, function(index, orders) {
                    $('#dataTable tbody').append(
                        '<tr>' +
                        '<td>' + orders.OrderID + '</td>' +
                        '<td>' + orders.OrderDate + '</td>' +
                        '<td>' + orders.TotalAmount + '</td>' +
                        '</tr>'
                    );
                });
                $('#dataTable').DataTable(); // Initialize DataTable
            } else {
                $('#dataTable tbody').append('<tr><td colspan="3">No orders found for the current month</td></tr>');
            }
        });

       

        var customerInfo = <?php echo json_encode($customer_info); ?>;

        $(document).ready(function() {
            $('#welcome_name').text(customerInfo.CustomerFirstName);
            $('#customerID').text('Customer ID: ' + customerInfo.CustomerID);
            $('#customerName').text('Customer Name: ' + customerInfo.CustomerName);
            $('#customerEmail').text('Email: ' + customerInfo.Email);
        });


    </script>

     
</body>
</html>
