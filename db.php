<?php
$host = 'localhost';
$db = 'loja_virtual';
$user = 'root';
$pass = '1234';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>