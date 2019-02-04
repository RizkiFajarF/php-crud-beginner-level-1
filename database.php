<?php
// digunakan untuk terhubung ke database. "HOW to connect to MYSQL database with PDO"
$host = "localhost";
$db_name = "php_beginner_crud_level_1";
$username = "root";
$password = "";

try {
$con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}

// show error
catch (PDOException $exception){
    echo "COnnection error; " . $exception->getMessage();
}
?>