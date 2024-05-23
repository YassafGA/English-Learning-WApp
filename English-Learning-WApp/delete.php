<?php
session_start();

include("connection.php");

// falan kullanıcı giriş yaptı..
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// id numara mı ve girildi mi (otomatik oluşuyor zaten numara) ..
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // veritabandan sil
    $query = "DELETE FROM kelimeler WHERE id = ? AND user_id = ?";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "is", $id, $user_id);
    mysqli_stmt_execute($stmt);

    // etkilenen girdi var mı..
    if(mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Word card deleted successfully.";
    } else {
        echo "No word card found to delete.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid ID.";
}

// anasayfaya gönderir..
header("Location: index.php");
exit;
?>