<?php
// conexionPDO.php

function conexionPDO() {
    // Configuración de la conexión
    $host = 'localhost'; // Si estás usando Laragon, generalmente localhost
    $database = 'bd_reto'; // Reemplaza con el nombre de tu base de datos
    $user = 'carla'; // El usuario que mencionaste
    $password = 'admin123'; // La contraseña que mencionaste

    try {
        // Crear una nueva instancia de PDO
        $pdo = new PDO("mysql:host=$host;dbname=$database", "$user", "$password");

        // Configurar PDO para lanzar excepciones en caso de errores
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;  // Solo devolver el objeto de conexión sin imprimir nada
    } catch (PDOException $e) {
        // Manejar la excepción si ocurre un error de conexión
        // No uses echo, mejor maneja el error de forma adecuada
        return null;
    }
}
?>
