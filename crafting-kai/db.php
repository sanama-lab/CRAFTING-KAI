<?php
$host = 'localhost';
$dbname = 'crafting-kai';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo ("cs");

?>