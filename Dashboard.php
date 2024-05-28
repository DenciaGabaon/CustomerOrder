<?php
include 'Dashboard_fetch.php'; // Include the file that fetches the data
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Order</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Dashboard.css">
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
            <img id="first" src="asset/Group 2.svg" alt="top">
            <img id="second" src="asset/Group 1.svg" alt="bottom">
        </div>
    </div>

    <div class="content">
        <div class="left_rect">
            <div class="top_rect">
                <div class="rect_1">
                    <p id="tp_1">Total Accounts</p>
                    <p id="tp_2">P100</p>
                </div>
                <div class="rect_2">
                    <p id="tp_1">Total Revenue</p>
                    <p id="tp_2">P100</p>
                </div>
                <div class="rect_3">
                    <p id="tp_1">Total Profit</p>
                    <p id="tp_2">P100</p>
                </div>
            </div>

            <div class="bottom_rect">
                <div class="order_rect">
                    <p>Order List</p>
                </div>
                  
                <div class="chart1">
                    <div class="chart1-label">
                        <p>Product Summary Per Category</p>
                    </div>
                    <div class="chart1-data">
                        <canvas id="Chart1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="right_rect">
            <div class="line_graph">
                <div class = "line_graph_label">
                    <p>Summary of Sales</p>
                </div>
                    <canvas id="lineChart" width="60" height="18"></canvas>
            </div>
            <div class="bar_graph">
                    <div class="bar_graph_label">
                        <p>Summary of Orders</p>
                    </div>
                    <canvas id="barChart" width="60" height="18"></canvas>
            </div>
        </div>    
    </div>

    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>

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
        const orderLabels = <?php echo $order_labels_json; ?>;
        const orderCounts = <?php echo $order_counts_json; ?>;

        // Create the line chart
        const ctxLine = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: orderLabels,
                datasets: [{
                    label: 'Orders over Time',
                    data: orderCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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

        // Get data from PHP for bar chart (same as line chart data in this example)
        const ctxBar = document.getElementById('barChart').getContext('2d');
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

    </script>
</body>
</html>
