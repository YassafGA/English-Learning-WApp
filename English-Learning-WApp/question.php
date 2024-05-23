<?php
session_start();

include("connection.php");
include("functions.php");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //girdileri al
    $user_email = $_POST['user_email'];
    $new_pass=$_POST['new_pass'];
    $repeat=$_POST['repeat'];

    if(!empty($user_email) && !empty($new_pass) && !empty($repeat)){
    if(strlen($new_pass)>=6)
    {
       
        //veritabandan oku
        $query = "select * from users where user_email = '$user_email' limit 1";
        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['user_email'] === $user_email)
                {
                    if($new_pass===$repeat){
                        $query = "select password from users where user_email='$user_email'";
                        $result = mysqli_query($con, $query);
                        if(mysqli_num_rows($result)>0){
                            $query = "update users set password='$new_pass' where user_email='$user_email'";
                            $result = mysqli_query($con, $query);
                        }
                    }else{
                        echo '<script>alert("şifreler uyuşmuyor!")</script>';
                    }
                }
            }else{
                echo '<script>alert("yanlış email girdiniz!")</script>';
            }
        }
    }else{
        echo '<script>alert("şifre en az 6 karakterden oluşmalı!")</script>';
    }
    }else{
        echo '<script>alert("boş alanları doldurun!")</script>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <div class="container">
        <div class="login_box">
            <form action="question.php" method="POST">
            <h1>change your password</h1>
            <input class="input" type="email" name="user_email" placeholder="type your email here"><br>
            <input class="input" type="password" name="new_pass" placeholder="type a new password"><br>
            <input class="input" type="password" name="repeat" placeholder="retype the password"><br><br>
            <input class="input" type="submit" name="email" id="email"><br><br>
            <p><a href="login.php">Login</a></p><br>
    </form>
    </div>
    </div>    
</body>
</html>