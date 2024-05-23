<!DOCTYPE html>
<html>
<head>
    <title>English App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="exam.css"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Anasayfa</a></li>
            <li class="r"><a href="logout.php">Çıkış</a></li>
            <li><a href="settings_form.php">Sınav Ayarları</a></li>
            <li><a href="report.php">Rapor Al</a></li>
        </ul>
    </nav>
    </body>
    </html>
<?php
include 'settings.php';  // Sınav ayarlarını içeren dosya
include 'connection.php';// Veritabanı bağlantısını
// Kullanıcı ayarlarından sorulacak yeni kelime sayısını al
$questionCount = isset($_SESSION['new_word_count']) ? $_SESSION['new_word_count'] : 10;  // Varsayılan olarak 10 soru
// daha önce cevaplanmamış kelimeleri seç
$sql = "SELECT id, kelime, ceviri FROM kelimeler WHERE correct_count = 0 LIMIT $questionCount";
$result = $con->query($sql);
echo '<form action="process_exam.php" method="post">';
if ($result->num_rows > 0) {
    // Sonuçlar üzerinde döngü yap
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "Kelime: " . $row["kelime"]. "<br>";
        echo "Cevabınız: <input type='text' name='answer[" . $row["id"] . "]' required>";
        echo "<input type='hidden' name='correct_answer[" . $row["id"] . "]' value='" . $row["ceviri"] . "'>";
        echo "</div><br>";
    }
    echo '<input type="submit" value="Cevapları Gönder">';
} else {
    echo "Yeni kelime yok.";
}
echo '</form>';
$con->close();
?>
