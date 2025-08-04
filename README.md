# Proyek UAS - Aplikasi Web Laravel Penjualan Buku BookSoul (sistem POS)

Aplikasi ini dibuat sebagai bagian dari tugas akhir mata kuliah Pemrograman Web Framework. Dibangun menggunakan Laravel, dengan Vite, Breeze, dan Blade sebagai stack utama.

## 📦 Stack Teknologi

- Laravel 12
- Vite
- Breeze (untuk autentikasi dan scaffolding)
- Blade Template Engine
- MySQL (untuk database)

## 🚀 Cara Menjalankan Proyek

### 1. Clone atau Ekstrak Proyek

Jika dari ZIP:
```bash
unzip nama-proyek.zip
cd nama-proyek
```

2. Install Dependensi
```bash
composer install
```

Tidak perlu menjalankan
```bash
npm install
```
karena proyek sudah dibuild.

Kecuali Anda ingin mengubah buildnya.

3. Konfigurasi Database
Edit file .env dan sesuaikan bagian ini dengan konfigurasi yang Anda inginkan:
APP_NAME=Booksoul
APP_ENV=production
APP_URL=http://www.bukujiwa.shop:2083/

DB_CONNECTION=mysql
DB_HOST=163.223.227.8
DB_PORT=3306
DB_DATABASE=hsstxfzu_bukujiwa
DB_USERNAME=hsstxfzu_bukujiwa
DB_PASSWORD="Lupa guweh"

4. Import Database atau Migrate
Import file database.sql (jika tersedia, silahkan dicek terlebih dahulu, setelah membuat database lokal/online) ke MySQL:

```bash
mysql -u root -p nama_database < hsstxfzu_bukujiwa.sql
```
Atau bisa melalui phpMyAdmin.

Bisa juga menjalankan file migrasi:
```bash
php artisan migrate
```

5. Jalankan Migration & Seeder (opsional, jika tidak impor SQL)

```bash
php artisan migrate
```
jangan jalankan opsi `--seed`, seeder belum update

6. Jalankan Aplikasi

```bash
php artisan serve
```

Lalu buka di browser (gunakan mode incognito, ada masalah  mode biasa sering bermasalah dalam caching):
http://localhost:8000

7. Jalankan Vite (untuk frontend)
Di terminal terpisah:

```bash
npm run dev
```

👤 Akun Demo

admin: aur@hakim.com - password

seller: z@z.com - password

pembeli regular (dapat diskon 5% total pembelian permanen): regular@regular.com - password

pembeli biasa: f@f.com - password


# Penutup

Terima kasih telah menggunakan aplikasi saya.

---

Lisensi: lisensi gratis dari para penyedia library php Laravel dan Javascript