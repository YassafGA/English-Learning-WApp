<?php
session_start();

// Ayarları güncelleme formu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['new_word_count'] = $_POST['new_word_count'];
    echo 'Ayarlar kaydedildi.';
    header("Location: exam.php");
    exit();
}

// Mevcut ayarı gösterme
$current_setting = isset($_SESSION['new_word_count']) ? $_SESSION['new_word_count'] : 10; // Varsayılan olarak 10 soru

?>
