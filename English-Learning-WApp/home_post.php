<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
//kullanıcıdan girilen inputları alır..
$user_id = $_SESSION['user_id'];
$kelime = $_POST["kelime"];
$ceviri = $_POST["ceviri"];
$cumle1 = $_POST["cumle1"];
$cumle2 = $_POST["cumle2"];
$cumle3 = $_POST["cumle3"];
$image = $_FILES['image'];
$path = "images/" . $image['name'];


$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;//hata mesajı
unset($_SESSION['error_message']);


//resim eklemek..
if (!empty($image['name'])) {
    if (move_uploaded_file($image['tmp_name'], $path)) {
    } else {
        
        echo '<script>alert("Resim yükleme hatası!")</script>';
        header("Location: index.php");
        exit();
    }
} else {
    $path = null; 
}

//giriş yoksa hata ver ..
if (empty($kelime) || empty($ceviri)) {
   $error_message = "Kelime ve çeviri alanları doldurulmalıdır!";
    header("Location: index.php?error_message=" . urlencode($error_message));
    exit();
}
//veritaban bağlantısı oluşturma..
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "english_db";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("INSERT INTO kelimeler (user_id, kelime, ceviri, cumle1, cumle2, cumle3, db_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssss", $user_id, $kelime, $ceviri, $cumle1, $cumle2, $cumle3, $path);

if ($stmt->execute()) {
    // başarılıysa..
    header("Location: index.php");
} else {
    // başarısızsa..
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>