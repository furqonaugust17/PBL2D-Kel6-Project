
<?php

return [
    [
        'label' => 'Main Menu',
        'is_label' => true,
        'roles' => ['administrasi', 'supervisor', 'teacher', 'asisten-studio'],
    ],
    [
        'name' => 'Dashboard',
        'icon' => 'flaticon-144-layout',
        'route' => 'dashboard',
        'roles' => ['administrasi', 'supervisor', 'teacher', 'asisten-studio'],
    ],
    [
        'name' => 'Pendaftaran',
        'icon' => 'fas fa-file-alt',
        'route' => 'pendaftaran.index',
        'roles' => ['administrasi'],
    ],
    [
        'name' => 'Pembayaran',
        'icon' => 'fas fa-money-bill',
        'route' => 'pembayaran.index',
        'roles' => ['administrasi'],
    ],
    [
        'name' => 'Monobi Art Space',
        'icon' => 'fas fa-chalkboard',
        'roles' => ['supervisor', 'teacher', 'asisten-studio'],
        'children' => [
            ['name' => 'Kelas', 'route' => 'artspace.index', 'roles' => ['supervisor', 'teacher']],
            ['name' => 'Kegiatan', 'route' => 'kegiatan-artspace.index', 'roles' => ['supervisor', 'teacher']],
            ['name' => 'Jadwal', 'route' => 'artspace-jadwal.index', 'roles' => ['supervisor', 'teacher', 'asisten-studio']],
        ],
    ],
    [
        'name' => 'Monobi Kids',
        'icon' => 'fas fa-chalkboard',
        'roles' => ['supervisor', 'teacher', 'asisten-studio'],
        'children' => [
            ['name' => 'Kelas', 'route' => 'kids.index', 'roles' => ['supervisor', 'teacher']],
            ['name' => 'Kategori', 'route' => 'kids-kategori.index', 'roles' => ['supervisor', 'teacher']],
            ['name' => 'Jadwal', 'route' => 'kids-jadwal.index', 'roles' => ['supervisor', 'teacher', 'asisten-studio']],
            ['name' => 'Tema', 'route' => 'kids-tema.index', 'roles' => ['supervisor', 'teacher']],
            ['name' => 'Harga', 'route' => 'kids-price.index', 'roles' => ['supervisor']],
        ],
    ],
    [
        'name' => 'Karyawan',
        'icon' => 'fas fa-users',
        'route' => 'karyawan.index',
        'roles' => ['supervisor'],
    ],
    [
        'name' => 'Customer',
        'icon' => 'fas fa-user',
        'route' => 'customer.index',
        'roles' => ['administrasi'],
    ],
    [
        'name' => 'Partner',
        'icon' => 'fas fa-users',
        'route' => 'partner.index',
        'roles' => ['administrasi', 'supervisor'],
    ],
    [
        'name' => 'Ruang',
        'icon' => 'fas fa-warehouse',
        'route' => 'ruang.index',
        'roles' => ['asisten-studio', 'supervisor', 'teacher'],
    ],
    [
        'name' => 'Diskon',
        'icon' => 'fas fa-percentage',
        'route' => 'diskon.index',
        'roles' => ['administrasi', 'supervisor'],
    ],
    [
        'name' => 'Galeri',
        'icon' => 'fas fa-images',
        'route' => 'galeri.index',
        'roles' => ['supervisor', 'asisten-studio'],
    ],
    [
        'name' => 'Inventaris',
        'icon' => 'fas fa-box',
        'route' => 'inventaris.index',
        'roles' => ['administrasi', 'asisten-studio', 'supervisor'],
    ],
];


?>