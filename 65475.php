<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "wordlist";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
} catch (PDOException $e) {
    echo "". $e->getMessage();
}

?>