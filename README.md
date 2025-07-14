# Project PBL TRPL 2D Kelompok 6 2024/2025

## Monobi Art Space Booking & Management System

Sistem ini dikembangkan untuk memenuhi kebutuhan **reservasi** dan **pengelolaan program** pada Monobi Art Space. Platform ini mendukung pengelolaan kelas untuk berbagai kategori seperti *Monobi Kids* dan *Monobi Art Space*.

## 🔧 Teknologi dan Third-Party Libraries

Project ini dibangun menggunakan:

- [Laravel](https://laravel.com/) - Framework PHP
- [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze) - Starter kit autentikasi sederhana
- [Laravel Spatie Permission](https://spatie.be/docs/laravel-permission) - Manajemen Role & Permission
- [Midtrans](https://midtrans.com/) - Payment gateway
- [Laravel DataTables](https://yajrabox.com/docs/laravel-datatables) - Integrasi DataTables untuk Laravel

## Project Manager

[@furqonaugust17](https://github.com/furqonaugust17) Furqon August Seventeenth

## Tim Project

- [@Abdhusyukra](https://github.com/Abdhusyukra) Muhammad 'Abdhu Syukra

- [@sarahsbrna](https://github.com/sarahsbrna) Sarah Sabrina

- [@kayabadesu](https://github.com/kayabadesu) Faiz Altamis Akhyar

## Social Media

![instagram](https://github.com/CLorant/readme-social-icons/blob/main/medium/filled/instagram.svg) Instagram : [@sixthforce.pbl](https://www.instagram.com/sixthforce.pbl/)


## Project
1. Clone Project:
```
git clone https://github.com/furqonaugust17/PBL2D-Kel6-Project.git
```

2. Install Dependency
```
composer install
```

3. Jalanlan AutoLoad
```
composer dump-autoload
```

4. Create .ENV
```
cp .env.example .env
```

5. Konfigurasi Mailer
```
MAIL_MAILER=
MAIL_SCHEME=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

6. Tambahkan Midtrans API Pada .ENV
```
MIDTRANS_CLIENT_KEY=
MIDTRANS_SERVER_KEY=
MIDTRANS_IS_PRODUCTION=
MIDTRANS_IS_SANITIZED=
MIDTRANS_IS_3DS=
```

7. Generate Application Key
```
php artisan key:generate
```

8. Run Migrations
```
php artisan migrate --seed
```

9. Run Application
```
php artisan serve
```

## 🧑‍💼 Akun Login (Untuk Keperluan Uji Coba)

| Role            | Email                                           | Password     |
|-----------------|--------------------------------------------------|--------------|
| Supervisor      | supervisor@supervisor.monobi.com                | password123  |
| Administrasi    | administrasi@administrasi.monobi.com            | password123  |
| Asisten Studio  | asisten-studio@asisten-studio.monobi.com        | password123  |
| Teacher         | teacher@teacher.monobi.com                      | password123  |
> Semua akun di atas telah diberikan role yang sesuai untuk melakukan pengujian pada sistem.

## 🔗 Link Demo

Akses aplikasi secara langsung melalui:
👉 [https://monobiart.space](https://monobiart.space)

---