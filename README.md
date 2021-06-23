setelah sudah di pull
disini saya menggunakana laravel 8(terbaru)
CARA INSTALL:
1. composer install = untuk install package yang ada di composer
2. buat database dengan nama mx_db
3. php artisan migrate = untuk menjalan perintah yang ada di database->migration. akan membuat table
4. disini saya untuk auth menggunakan jwt package dari tymon. berikut link gitlabnya : https://github.com/tymondesigns/jwt-auth
5. php artisan jwt:secret = untuk mengenreate key jwt
6. jika ingin mengconfig publish jwt : php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
7. php artisan serve = untuk menjalan aplikasi tersebut.
8. oiya untuk .env sudah saya push juga ya.

Penjelasan:
1. saya membuat 1 folder helper agar bisa modular, saya memasukan response api mungkin nanti kedepannya untuk function function yang akan dipakai dibanyak tempat bisa di taro disitu.
2. agar bisa terbaca folder helper, harus di edit pada bagian composer.json didalam autoload-dev ditambahkan files['{nama-file}']
3. lalu saya membuatkan 3 folder controller untuk mempermudah kedepannya jika mau dikembangkan biar tidak tercecer saat mencari bug ataupun filenya hihi xD
4. company bisa melakukan login dan register
5. freelancer bisa melakukan login dan register
6. company bisa menambahkan job
7. freelancer bisa mengapply / mendaftar pekerjaan
8. company bisa melihat hasil upload yang sudah di daftarkan oleh pdf dalam bentuk pdf
9. untuk melihat hasil pdf. ex : http://127.0.0.1:8000/file-pdf/1624472954-admin.pdf atau http://127.0.0.1:8000/file-pdf/{filename} 
10. setiap freelance ataupun company jika ingin mengakses data job harus melakukan login terlebih dahulu agar dapet token lalu dimasukan ke dalam authorization -> bearer token
11. saya membuat middleware untuk jwtauthcheck = untuk mencheck apakah data tersebut sudah terdaftar apa belum.
12. lalu saya tambahkan kedalam kernel
13. untuk routing saya buatin 1 folder dengan nama api untuk nanti jika ingin dikembankan lagi tinggal menambahkan folder lalu diakses sesuai dengan nama folder
14. saya memasukan middleware bukan di route akan tetapi di APP->PROVIDERS/RouteServiceProvider.php
15. saya membuat 1 function untuk mempermudah pemanggilan dan kerapihan codenya dengan menggunakan fungsi glob lalu di looping

Berikut penjelasan saya. Terimakasih sebelumnya dan mohon maaf baru bisa dikirim sekarang dikarenakan laptop saya yang sebelumnya hilang dan harus sempat hilang semangat, tapi sekarang sudah tidak xD. Sekali lagi Terimakasih semoga suka.

Thanks,
Faisal Achmad Dwi Cahyono
