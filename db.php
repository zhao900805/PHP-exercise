<?php
$dsn = 'mysql:host=localhost;dbname=427_db';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
//$db = new PDO($dsn, $username, $password, $options);
try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "err!";
    exit();
}
?>