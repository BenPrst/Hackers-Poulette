<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$dsn = "mysql:host=localhost;dbname=supportcontact";
$user = "root";
$passwd = "";
$pdo = new PDO($dsn, $user, $passwd);
