<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Aplikasi Reservasi Kendaraan

Aplikasi ini digunakan untuk mengelola reservasi kendaraan dalam perusahaan.

## Spesifikasi Teknis

-   **PHP Version**: 8.1.6
-   **Database Version**: MySQL 5.2
-   **Framework**: Laravel 10.22.0

## Daftar Akun

| Role       | Username | Email                | Password |
| ---------- | -------- | -------------------- | -------- |
| Admin      | admin    | admin@admin.com      | admin    |
| Supervisor | super    | supervisor@email.com | password |
| Manager    | manager  | manager@email.com    | password |
| Employee   | employee | employee@email.com   | password |

## Panduan Penggunaan

1. **Login dan Register**: Masuk atau Daftar ke aplikasi menggunakan akun yang telah disediakan.
2. **Dashboard**: Di halaman utama, Anda akan melihat ringkasan data dan grafik terkait reservasi dan kendaraan.
3. **Reservasi**: Anda dapat menambah, mengedit, atau menghapus reservasi. Supervisor dan Manager memiliki hak untuk menyetujui atau menolak reservasi. Untuk melakukan persetujuan atau menolak reserved harus login sebagai supervisor atau manager yang sesuai dengan user_approval_id pada data.
4. **Kendaraan**: Halaman ini digunakan untuk mengelola data kendaraan. Anda dapat menambah, mengedit, atau menghapus data kendaraan.
5. **Datatable Sorting and Searching**: Pada halaman index Reservasi dan Kendaraan Terdapat Datatable yang dapat di sorting per column dan melakukan search sesuai dengan input user.
6. **Profil**: Anda dapat mengubah informasi profil dan password Anda di halaman ini.

## Instalasi dan Setup

1. Clone repositori ini.
2. Jalankan `composer install` untuk menginstall dependencies.
3. Salin `.env.example` ke `.env` dan sesuaikan konfigurasi basis data Anda.
4. Jalankan `php artisan key:generate` untuk menghasilkan kunci aplikasi.
5. Jalankan `php artisan migrate` untuk membuat tabel di basis data.
6. Jalankan `php artisan db:seed` untuk mengisi data awal ke dalam basis data (opsional).
7. Jalankan `php artisan serve` untuk memulai server pengembangan lokal.

## Struktur Database

Berikut gambaran stuktur database dari aplikasi Trans Suite ini

![Database Structure](./Database%20Structure.png)

## Activity Diagram

Berikut gambaran stuktur activity diagram dari aplikasi Trans Suite ini

![Activity Diagram](./Activity%20Diagram.png)

## License

Create by [Muhammad Zhafran Ammar](https://potofolio-venteux.vercel.app/)
