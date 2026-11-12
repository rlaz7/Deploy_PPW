<?php

// Mengambil kredensial dari Railway (jika ada), atau gunakan lokal sebagai cadangan
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'ruang_hukum');
define('DB_USER', getenv('DB_USER') ?: 'RlazDB');   
define('DB_PASS', getenv('DB_PASSWORD') ?: 'r476'); 

function getDatabase(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        // Tambahkan DB_PORT ke dalam koneksi DSN
        $dsn = 'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';charset=utf8mb4';
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
            PDO::ATTR_EMULATE_PREPARES   => false,                  
        ];
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

        $pdo->exec("SET time_zone = '+07:00'"); // Zona waktu Jakarta
    }

    return $pdo;
}