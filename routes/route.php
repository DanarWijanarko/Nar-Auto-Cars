<?php

// Ambil URL dari Browser
$requestURL = parse_url($_SERVER['REQUEST_URI'])['path'];

// Associative Array == 'key' => 'value'
// Variable Array Untuk Menyimpan URL "'Variabel Untuk Menyimpan Halaman' => 'URL Tiap Halaman Pada Folder'"
// 'Variabel Untuk Menyimpan Halaman' === Yang Akan Digunakan Untuk Setiap Button Pada Project
$arrRoutes = [
    // ADMIN
    '/Web-Dealer/chatForm-admin' => 'views/admin/chatForm-admin.php',
    '/Web-Dealer/newData-admin' => 'views/admin/newData-admin.php',
    '/Web-Dealer/productList-admin' => 'views/admin/productList-admin.php',
    // LOGIN & REGISTER
    '/Web-Dealer/login' => 'views/logres/login.php',
    '/Web-Dealer/logout' => 'views/logres/logout.php',
    '/Web-Dealer/register' => 'views/logres/register.php',
    // USERS
    // Main
    '/Web-Dealer/' => 'views/users/main/home.php',
    '/Web-Dealer/our-product' => 'views/users/main/our-product.php',
    '/Web-Dealer/product-list' => 'views/users/main/product-list.php',
    '/Web-Dealer/about' => 'views/users/main/about.php',
    // See More
    '/Web-Dealer/brio' => 'views/users/see-more/brio.php',
    '/Web-Dealer/brv' => 'views/users/see-more/brv.php',
    '/Web-Dealer/civic' => 'views/users/see-more/civic.php',
    '/Web-Dealer/crv' => 'views/users/see-more/crv.php',
    '/Web-Dealer/hrv' => 'views/users/see-more/hrv.php',
    '/Web-Dealer/mobilio' => 'views/users/see-more/mobilio.php',
    // Generate Database
    '/Web-Dealer/generate' => 'Assets/functions/generate.php'
];

function Route($requestURL, $arrRoutes) {
    // array_key_exist Digunakan Untuk Memanggil Data yang Sama Dengan REQUEST dari URL
    if (array_key_exists($requestURL, $arrRoutes)) {
        // Example '/Web-Dealer/login' dari RequestURL(Inputan dari User) === '/Web-Dealer/login' pada arrAssoc ==> Akan Men-direct ke Halaman 'views/logres/login.php'
        require $arrRoutes[$requestURL];
    // Jika Tidak Ada Data yang Sama Dengan REQUEST URL akan Menjalankan Function abort
    } else {
        abort(404);
    }
}

function abort($code) {
    http_response_code($code);
    require "views/error/{$code}.php";
    die();
}

Route($requestURL, $arrRoutes);