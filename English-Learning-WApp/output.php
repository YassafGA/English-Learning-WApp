<?php
session_start();

include("connection.php");

// kullanıcı oturumu..
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// hangi kullanıcı..
$query = "SELECT * FROM kelimeler WHERE user_id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// sonuç var mı..
if ($result) {
    $word_cards = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $word_cards = []; // boş dizi
}

mysqli_stmt_close($stmt);


?>