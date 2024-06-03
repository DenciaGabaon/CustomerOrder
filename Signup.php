<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Paytone+One&family=Pixelify+Sans:wght@400..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class= "login_page">
        <div class="login_box">

            <div class="login">
                <div class="logo">
                    <img src="asset\logo.png" alt="logo">
                </div>
                <form id="mainFormcc" action="" method="post">     
                    <input type="text" id="input1cc" name="input1cc" placeholder="First Name" required>
                    <input type="text" id="input2cc" name="input2cc" placeholder="Last Name" required>
                    <input type="text" id="input3cc" name="input3cc" placeholder="Email" required>
                    <input type="password" id="input4cc" name="input4cc" placeholder="Password" required>
                    <input type="password" id="input5cc" name="input5cc" placeholder="Re-enter password" required>
                    <button type="submit" name="login">Sign up</button>
                </form>
                <!-- <form  method="POST" action= "login.php">
                    <input type="text" id="input" name="fname" placeholder="First Name" required>
                    <input type="text" id="input" name="lname" placeholder="Last Name" required>
                    <input class = "input1" type="text" id="input" name="user" placeholder="Username" required>
                    <button type="submit" name="login">Sign up</button>
                </form> -->

            </div>
        </div>
        <div class="bg_image">
                <img src="asset\bg.svg" alt="bg">
        </div>
    </div>
    
</body>
<footer>
        
</footer>

<script>
         // Prevent the default form submission behavior
         document.getElementById("mainFormcc").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get form data
            var formData = new FormData(this);

            // Send form data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "Signupretrieve.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        if (xhr.responseText === "error") {
                            alert('Error: Passwords do not match');
                        } else {
                            alert('Registration successful');
                            window.location.href = 'Home.php';
                        }
                    } else {
                        // Handle errors if any
                        alert('Error: ' + xhr.responseText);
                    }
                }
            };
            xhr.send(formData); // Send form data
        });
    </script>
</html>