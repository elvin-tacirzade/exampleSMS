Bu basit bir ExampleSMS Api örneğidir
# Kullanım
Projeyi bilgisayarınıza yükledikten sonra terminalde `composer update` demeniz gerekir. Ardından `.env` dosyasında `DB_DATABASE` alanını doldurarak yeniden terminalde `php artisan migrate` komutunu çalıştırıyorsunuz. `Your app key is missing` hatası almamak için terminalde `php artisan key:generate` diyoruz. Artık rahatlıkla `php artisan serve` diyerek projeyi başlata bilirsiniz.

# Dokümantasyon
Api dokümantasyon ve test için tarayıcınızda `/api/documentation` adresine gitmeniz yeterli olucaktır.

# Unit Test
Projeyi test etmek için önce `.env` dosyasında `DB_DATABASE` alanını `test` yapmanız gerekiyor. Aksi taktirde hata alırsınız. (`test` ismini değiştirmek için `phpunit.xml` dosyasından `DB_DATABASE` kısmını güncellemeniz gerekiyor). Ardından terminalde `php artisan migrate` diyerek tabloları oluşturuyoruz.

Unit testi çalıştırmak için terminalde `"./vendor/bin/phpunit"` demeniz yeterlidir.
