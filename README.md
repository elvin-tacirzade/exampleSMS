Bu basit bir ExampleSMS Api örneğidir
# Kullanım
Projeyi bilgisayarınıza yükledikten sonra terminalde `composer update` demeniz gerekir. Ardından `.env` dosyasında `DB_DATABASE` alanını doldurarak yeniden terminalde `php artisan migrate` komutunu çalıştırıyorsunuz. Artık rahatlıkla `php artisan serve` diyerek projeyi başlata bilirsiniz.

# Dokümantasyon
Api dokümantasyon ve test için tarayıcınızda `/api/documentation` adresine gitmeniz yeterli olucaktır.

# Unit Test
Projeyi test etmek için önce `test` isimli database olması gerekiyor. Aksi taktirde hata alırsınız. (`test` ismini değiştirmek için `phpunit.xml` dosyasından `DB_DATABASE` kısmını güncellemeniz gerekiyor.)

Unit testi çalıştırmak için terminalde `"./vendor/bin/phpunit"` demeniz yeterlidir.
