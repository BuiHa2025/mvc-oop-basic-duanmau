<?php

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL', 'http://localhost/mvc-oop-basic-duanmau/');

define('DB_HOST', 'localhost');
define('DB_PORT', 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ruou_store');  // Tên database
define('PATH_VIEW', dirname(__DIR__) . '/views/');

define('PATH_ROOT', __DIR__ . '/../');
