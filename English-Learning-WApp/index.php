<?php
session_start();

include("connection.php");//veritaban bağlantısı

// kullanıcı giriş yaptı mı ona bakar..
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// giriş yapan kullanıcının girdiği kelimeler (fetch) ..
$query = "SELECT * FROM kelimeler WHERE user_id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// sonuc var mı ..
if ($result) {
    $word_cards = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $word_cards = []; // bos dizi kelime bulunmazsa diye
}

mysqli_stmt_close($stmt);
// oturumda yada url de hata tespiti ..
$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Clear the error message after displaying it
} elseif (isset($_GET['error_message'])) {
    $error_message = $_GET['error_message'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>English App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<div class="container">
        
    <nav class="navbar">
        <ul>
            
            <li><a href="exam.php">Sınav</a></li>
            <li class="r"><a href="logout.php">Çıkış</a></li>
            <li><a href="settings_form.php">Sınav Ayarları</a></li>
            <li><a href="report.php">Rapor Al</a></li>

        </ul>
    </nav>

    <!-- hata mesajı alanı -->
<?php if (!empty($error_message)) : ?>
    <p class="error-message">
        <?php echo $error_message; ?> 
    </p>
<?php endif; ?>

    <form action="home_post.php" method="POST" enctype="multipart/form-data">
        <div class="fun">
            <div class="left">
                <p>Bir kelime yaz :</p>
                <input type="text" name="kelime" class="input" id="kelime"><br><br>
                <p>Kelimenin çevirisini yaz :</p>
                <input type="text" name="ceviri" class="input" id="ceviri"><br><br>
                <p>Bu kelimeyle ilgili üç cümle yaz :</p>
                <input type="text" name="cumle1" class="input" id="cumle" placeholder="Cümle 1.."> <br><br>
                <input type="text" name="cumle2" class="input" id="cumle" placeholder="Cümle 2.."> <br><br>
                <input type="text" name="cumle3" class="input" id="cumle" placeholder="Cümle 3.."> <br>
                <p>Resim yükle :</p>
                <input type="file" name="image"><br><br>
                <button type="submit" id="btn">Gönder</button>
            </div>
        
    </form>
    
    <div class="right">
        <table>
            <thead>
                <tr>
                    <th>Kelime:</th>
                    <th>Çevirisi:</th>
                    <th>Cumle1:</th>
                    <th>Cumle2:</th>
                    <th>Cumle3:</th>
                    <th>Resim:</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($word_cards as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['kelime']); ?></td>
                        <td><?php echo htmlspecialchars($row['ceviri']); ?></td>
                        <td><?php echo htmlspecialchars($row['cumle1']); ?></td>
                        <td><?php echo htmlspecialchars($row['cumle2']); ?></td>
                        <td><?php echo htmlspecialchars($row['cumle3']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['db_image']); ?>" class="img"></td>
                        <td><a class="delete_btn" href="delete.php?id=<?php echo $row['id']; ?>">sil</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
</body>
</html>