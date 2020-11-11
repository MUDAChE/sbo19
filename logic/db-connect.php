<?php

$driver = 'mysql';
$host = 'localhost';
$dbName = 'forumsbo';
$charset = 'utf8';
$dbUserName = 'root';
$dbUserPass = '';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $connectDB = new PDO("$driver:host = $host; $dbName; $charset", $dbUserName, $dbUserPass, $options);
    session_start();

} catch (PDOException $e) {
    $e->getMessage() . '<br>';
    die('Не возможно подключиться к базе данных');
}