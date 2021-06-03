<?php session_start();
$serverName = 'localhost';
$userName = 'omer_shakeel_17902';
$password = '123456';
$database = 'omair_mairaj_17849';
$conn = mysqli_connect($serverName, $userName, $password, $database);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//   }
//   echo "Connected successfully";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="loginstyle.css">
</head>

<body>
    <h1 class="logo">LOGO</h1>
    <div class="banner-area">
        <ul class="box-area">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <header>

        </header>

        <div id="content2" class="login">
            <h1>LOGIN</h1>
            <form action="" method="post">
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="div">
                        <input type="text" name="Username" class="input" placeholder="Username">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div class="div">
                        <input type="password" name="Password" class="input" placeholder="Password">
                    </div>
                </div>
                <a href="#" class="forgot">Forgot Password?</a>
                <input type="submit" name="login-btn" class="btn" value="Login">
            </form>

            <?php
            $conn = mysqli_connect('localhost', 'omer_shakeel_17902', '123456', 'omair_mairaj_17849');

            if (isset($_POST['login-btn'])) {
                if (!empty($_POST['Username']) && !empty($_POST['Password'])) {
                    $username = $_POST['Username'];
                    $password = $_POST['Password'];

                    $select = "SELECT * FROM employees WHERE Username='$username'";

                    $run = mysqli_query($conn, $select);
                    $row_emp = mysqli_fetch_array($run);
                    $num_rows = mysqli_num_rows($run);

                    if ($num_rows != 0) {
                        $db_username = $row_emp['Username'];
                        $db_password = $row_emp['Password'];
                        $db_department = $row_emp['Department_id'];

                        if ($username == $db_username && $password == $db_password) {
                            if($db_department == 20){
                                echo "<script>window.open('ClaimPage.php','_self');</script>";
                            }
                            elseif($db_department == 30){
                                echo "<script>window.open('ManagerPage.php','_self');</script>";
                            }
                            elseif($db_department == 40){
                                echo "<script>window.open('FinishedGoods.php','_self');</script>";
                            }
                            elseif($db_department == 50){
                                echo "<script>window.open('Manufacturing.php','_self');</script>";
                            }
                            $_SESSION['Username'] = $db_username;
                        } else {
                            echo '<script>alert("Wrong username or password");</script>';
                        }
                    } else {
                        echo '<script>alert("Invalid Username or Password");</script>';
                    }
                }
                else{
                    echo '<script>alert("All fields are required");</script>';
                }
            }
            ?>
        </div>

    </div>
</body>

</html>