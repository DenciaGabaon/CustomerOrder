<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Home.css">
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
                    <img src="asset\logo.svg" alt="logo">
                    <div class="logo_half"></div>
                </div>
                <form  method="POST" action= "login.php">
                    <input class = "input1" type="text" id="input" name="user" placeholder="Email" required>
                    <input type="password" id="input" name="pass" placeholder="Password" required>
                    <button type="submit" name="login">Login</button>
                </form>
                <div class= "Signup">
                    <p id = newacc>Don't have an account? <a href="signup.php" id = "signup">Sign Up</a></p>
                    
                </div>
            </div>
        </div>
        <div class="bg_image">
                <img src="asset\bg.svg" alt="bg">
        </div>
    </div>
    
</body>
<footer>
        
</footer>
</html>