
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sınav Ayarları</title>
    <link rel="stylesheet" href="exam.css">
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Anasayfa</a></li>
            
            <li class="r"><a href="logout.php">Çıkış</a></li>
            <li><a href="exam.php">Sınav</a></li>
            <li><a href="report.php">Rapor Al</a></li>

        </ul>
    
    </nav>
    <h1>Yeni Kelimeler İçin Sınav Ayarları</h1>
    <form action="settings.php" method="post">
        <label for="new_word_count">Sorulacak yeni kelime sayısını giriniz:</label>
        <input type="number" name="new_word_count" id="new_word_count" value="<?php echo $current_setting; ?>" min="1" max="50" required>
        <input type="submit" value="Ayarları Kaydet">
    
    </form>
</body>
</html>
