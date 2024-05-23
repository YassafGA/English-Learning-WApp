<?php
session_start();

include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // girdileri al
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

        // veritabandan oku
        $query = "SELECT * FROM users WHERE user_name = ? LIMIT 1";

        // Prepare statement
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $user_name);
        mysqli_stmt_execute($stmt);

        // sonuç al..
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            // şifre controlu..
            if ($user_data['password'] === $password) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                exit;
            } else {
                echo '<script>alert("Yanlış şifre veya kullanıcı adı!")</script>';
            }
        } else {
            echo '<script>alert("Kullanıcı bulunamadı!")</script>';
        }

        mysqli_stmt_close($stmt);

    } else {
        echo '<script>alert("Boş alanları doldurun!")</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>

<div class="container">
    <div class="login_box">
        <form method="post">
            <h1>Login</h1>

            <input class="input" type="text" name="user_name" placeholder="Kullanıcı adı"><br><br>
            <input class="input" type="password" name="password" placeholder="Şifre"><br><br>

            <input class="input" type="submit" value="Giriş"><br><br>

            <p><a href="signup.php">Kaydolmak için tıklayın</a></p><br>
            <p><a href="question.php">Şifrenizi mi unuttunuz?</a></p><br><br>
        </form>
    </div>
</div>

</body>
</html>