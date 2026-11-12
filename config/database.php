<?php

// Gunakan $_SERVER sebagai prioritas pertama untuk membaca variabel dari Railway
define('DB_HOST', $_SERVER['DB_HOST'] ?? getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', $_SERVER['DB_PORT'] ?? getenv('DB_PORT') ?: '3306');
define('DB_NAME', $_SERVER['DB_NAME'] ?? getenv('DB_NAME') ?: 'ruang_hukum');
define('DB_USER', $_SERVER['DB_USER'] ?? getenv('DB_USER') ?: 'RlazDB');   
define('DB_PASS', $_SERVER['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?: 'r476'); 

function getDatabase(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';charset=utf8mb4';
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
            PDO::ATTR_EMULATE_PREPARES   => false,                  
        ];
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

        $pdo->exec("SET time_zone = '+07:00'");
    }

    return $pdo;
}