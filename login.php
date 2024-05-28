<?php

include 'db.php';

unset($uname); 
unset($upass); 
//error_log("username: $uname");
//error_log("password: $upass");


error_log("puta ");
if (isset($_POST['login'])) {
    $UserName = $_POST['user'];
    $UserPass = $_POST['pass'];
    $sql = "SELECT * FROM users WHERE UserName = ? AND UserPass = ?";
    $stmt = $conn->prepare($sql);
    $stmt ->bind_param('ss', $UserName, $UserPass);
    //echo $UserName;
    echo "puta1";
    //$result = $stmt->execute();
    //error_log("result".$result) ;
    $stmt->execute();
    $stmt->bind_result($UserID,$UserName, $UserPass);
    if ($stmt->fetch()) {
        error_log("Login successful, ". $UserName);
        echo "puta";
        error_log("userid: ". $UserID);
        if ($UserName == 'admin'){
            $data = $UserName;
            header("Location: CustomerOrder.php?data=".urlencode($data));
            exit();
        } else {
            $data = $UserName;
            header("Location: Home.php?data=".urlencode($data));
            exit();
        }
    } else {
        echo "puta2";
        echo $UserName;
        unset($UserName);
        unset($UserPass);
        echo "<script>
                alert('Login Failed');
                window.location.href = 'login_page.php';
            </script>";
        exit();
    }
    
    $stmt->close();
}
?>
