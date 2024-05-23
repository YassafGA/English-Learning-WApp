<?php
session_start();

include("connection.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // girdiler ..
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $password = $_POST['password'];

    // boş mu değil mi ..
    if(!empty($user_name) && !empty($user_email) && !empty($password) && !is_numeric($user_name)) {
        // email kontrolu..
        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Geçersiz email formatı!")</script>';
        } elseif (strlen($password) < 6) {
            echo '<script>alert("Şifre en az 6 karakterden oluşmalı!")</script>';
        } else {
            // user_id oluştur..
            $user_id = random_num(20);

            // veritabana gir (hashing password yapmak isterdik ama istenmedi :( )
            $query = "INSERT INTO users (user_id, user_name, user_email, password) VALUES ('$user_id', '$user_name', '$user_email', '$password')";
            $result = mysqli_query($con, $query);

            if ($result) {
                header("Location: login.php");
                die;
            } else {
                echo '<script>alert("Kayıt sırasında bir hata oluştu. Lütfen tekrar deneyin!")</script>';
            }
        }
    } else {
        echo '<script>alert("Boş alanları doldurun!")</script>';
    }
}

function random_num($length){
    $text = "";
    if($length < 5){
        $length = 5;
    }
    $len = rand(4, $length);
    for ($i = 0; $i < $len; $i++){
        $text .= rand(0,9);
    }
    return $text;
}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="login_style.css">
	<title>Signup</title>
</head>
<body>
	
<div class="container" >
		<div class="box">
		
		<form method="post">
			<h1>Sign Up</h1>
			<input class="input" type="text" name="user_name" placeholder="username"><br><br>
			<input class="input" type="email" name="user_email" placeholder="email"><br><br>
			<input class="input" type="password" name="password" placeholder="password"><br><br>

			<input class="input" type="submit" value="Signup"><br><br>

			<p><a href="login.php">Click to Login</a></p><br><br>
		</form>
	</div>
	</div>
</body>
</html>