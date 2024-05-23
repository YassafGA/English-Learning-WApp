<?php
session_start();

include 'connection.php';// Veritabanı bağlantısını

$known_words = [];// Bilinen sorular dizisi

// Kullanıcıdan alınan cevapları işle..
if (!empty($_POST['answer'])) {
    foreach ($_POST['answer'] as $id => $user_answer) {
        $correct_answer = $_POST['correct_answer'][$id];
        $correct = (strtolower($user_answer) == strtolower($correct_answer)) ? 1 : 0;

        // Doğru cevaba göre correct_count ve next_test_date güncelle..
        if ($correct) {
            // Mevcut correct_count değerini al..
            $sql = "SELECT correct_count FROM kelimeler WHERE id = $id";
            $result = $con->query($sql);
            $row = $result->fetch_assoc();
            $correct_count = $row['correct_count'];
            
            if ($correct_count == 6) {
                $next_test_date = date('Y-m-d', strtotime('+1 year'));
                $correct_count++;
            } elseif ($correct_count == 5) {
                $next_test_date = date('Y-m-d', strtotime('+6 months'));
                $correct_count++;
            } elseif ($correct_count == 4) {
                $next_test_date = date('Y-m-d', strtotime('+3 months'));
                $correct_count++;
            } elseif ($correct_count == 3) {
                $next_test_date = date('Y-m-d', strtotime('+1 month'));
                $correct_count++;
            } elseif ($correct_count == 2) {
                $next_test_date = date('Y-m-d', strtotime('+1 week'));
                $correct_count++;
            } elseif ($correct_count == 1) {
                $next_test_date = date('Y-m-d', strtotime('+1 day'));
                $correct_count++;
            } elseif ($correct_count == 0) {
                $next_test_date = date('Y-m-d', strtotime('+1 day'));
                $correct_count++;
            } elseif ($correct_count == 7) {
                $next_test_date = null; // Birdaha sorma
                $known_words[] = $id; // Bilinen sorulara ekle
            }

            // correct_count ve next_test_date güncelle..
            $sql = "UPDATE kelimeler SET correct_count = $correct_count, next_test_date = '$next_test_date' WHERE id = $id";
            $con->query($sql);
        }

        // Yanıtın doğruluğuna göre kullanıcıya geri bildirim..
        if ($correct) {
            echo "Doğru! Kelime: $user_answer<br>";

        } else {
            echo "Yanlış! Kelime: $user_answer, Doğru Cevap: $correct_answer<br>";
        }
    }
}

// Bilinen sorular dizisini güncelle..(iptal edildi o yüzden yorum halinde bunun yerine report.php oluşturduk :) )
//    if (!empty($known_words)) {
// Burada bilinen soruları işleyebiliriz.
// Örneğin, bir dosyaya yazabilir veya veritabanında başka bir tabloya ekleyebiliriz.
// Örneğin, bilinen kelimeleri bir dosyaya yazmak için:
//    $file = fopen('known_words.txt', 'a');
//    foreach ($known_words as $word_id) {
//        fwrite($file, $word_id . PHP_EOL);
//    }fclose($file);}

$con->close();
?>
