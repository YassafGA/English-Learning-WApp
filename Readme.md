## Proje Açıklaması
Bu proje, kelime ezberleme sürecini optimize etmek amacıyla 6 sefer tekrar prensibi üzerine kurulmuştur. Kullanıcıların kelimeleri daha etkili bir şekilde öğrenmelerini sağlamak için her kelimenin altı kez doğru yanıtlanması gereken sınav modülleri içermektedir. Proje, kullanıcı kayıt sistemi, kelime ekleme modülü, sınav modülü, ayarlar ve analiz rapor modüllerini içermektedir.

## Özellikler

1. *Kullanıcı Kayıt Modülü*
   - Kullanıcı kaydı, giriş yapma ve şifremi unuttum fonksiyonları.

2. *Kelime Ekleme Modülü*
   - Kullanıcıların İngilizce kelimeleri Türkçe karşılıkları, cümle içinde kullanımı ve ilgili resim eklemelerini sağlar.

3. *Sınav Modülü*
   - Kullanıcıların kelimeleri altı kez doğru yanıtlaması gereken sınavlar. 
   - Bilinen kelimeler belirli aralıklarla tekrar sorulur: 1 gün, 1 hafta, 1 ay, 3 ay, 6 ay ve 1 yıl sonra.
   
4. *Ayarlar Modülü*
   - Kullanıcıların günlük karşılaşacakları yeni kelime sayısını ayarlayabilmeleri.

5. *Analiz Rapor Modülü*
   - Kullanıcıların kelime bilgilerini yüzdesel olarak gösteren raporlar.
   - Raporlar kağıt üzerinde çıktı alınabilir.

## Kurulum

### Gereksinimler
- PHP 7.0 veya üzeri
- MySQL
- Bir web sunucusu (Apache, Nginx, vb.)

### Adımlar

1. *Depoyu Klonlayın*
   bash
   git clone [proje linki]
   cd [proje dizini]
   

2. *Gerekli Bağımlılıkları Kurun*
   PHP ve MySQL kurulu olduğundan emin olun.
   

3. *Veritabanı Kurulumu*
   - MySQL sunucunuzda DataBase.sql dosyasını içe aktarın
   

4. *Uygulamayı Çalıştırın*
   roje dosyalarını web sunucunuzun kök dizinine kopyalayın. Web sunucunuzu başlatın ve tarayıcınızda http://localhost/English-Learning-WApp adresine gidin.
   

## Kullanım

### Kullanıcı Kayıt ve Giriş
1. Ana sayfadan kullanıcı kaydı oluşturun.
2. kullanıcı-Adı ve şifre ile giriş yapın.

### Kelime Ekleme
1. Kelime Ekleme bölümüne gidin.
2. Gerekli alanları doldurun ve kelimeleri ekleyin.

### Sınav Modülü
1. Sınav bölümüne girin.
2. Günlük sınavınızı tamamlayın ve sonuçlarınızı takip edin.

### Ayarlar
1. Ayarlar bölümünden yeni eklenen kelime sayısını ayarlayın.

### Analiz Raporları
1. Rapor bölümünden başarı raporlarınızı görüntüleyin ve çıktı alın.

## Katkıda Bulunma

### Projeyi Forklayın
- Projeyi GitHub'dan forklayın.

### Yeni Özellikler Ekleyin
- Yeni özellikler için bir dal (branch) oluşturun.
   bash
   git checkout -b yeni-ozellik
   

### Değişiklikleri Commitleyin
   bash
   git commit -m "Yeni bir özellik eklendi"
   

### Değişiklikleri Gönderin
   bash
   git push origin yeni-ozellik
   

### Pull Request Oluşturun
- GitHub üzerinde bir pull request oluşturun.

## Teşekkürler