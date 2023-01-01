<?php
try {
    $connectionString = "mysql:host=localhost;dbname=wia2003";
    $user = "root";
    $pass = "";

    $pdo = new PDO($connectionString, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>