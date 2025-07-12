# Project PBL TRPL 2D Kelompok 6 2024/2025

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

4. Tambahkan Midtrans API Pada .ENV
```
MIDTRANS_CLIENT_KEY=
MIDTRANS_SERVER_KEY=
MIDTRANS_IS_PRODUCTION=
MIDTRANS_IS_SANITIZED=
MIDTRANS_IS_3DS=
```

5. Generate Application Key
```
php artisan key:generate
```

6. Run Migrations
```
php artisan migrate --seed
```

7. Run Application
```
php artisan serve
```



