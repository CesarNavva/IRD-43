<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "mascotas";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    // Establecer el modo de error PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}
?>
