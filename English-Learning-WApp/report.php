<?php
session_start();
include 'connection.php';// Veritaban bağlantısı
// Kullanıcının çözümlediği kelimeleri ve correct_count değerlerini çek
$sql = "SELECT kelime, ceviri, correct_count FROM kelimeler WHERE correct_count > 0";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Raporu tablo halinde göster
    echo '<h1>Çözümlediğiniz Kelimeler Raporu</h1>';
    echo '<table border="1">';
    echo '<tr><th>Kelime</th><th>Çeviri</th><th>Çözümleme Sayısı</th></tr>';
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["kelime"] . '</td>';
        echo '<td>' . $row["ceviri"] . '</td>';
        echo '<td>' . $row["correct_count"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<br><button onclick="window.print()">Raporu Yazdır</button>';
} else {
    echo 'Henüz çözümlediğiniz kelime bulunmamaktadır.';
}

$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Çözüm Raporu</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
</body>
</html>
