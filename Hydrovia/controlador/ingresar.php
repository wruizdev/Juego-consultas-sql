
<?php
require("../modelo/conexionPDO.php");


// Iniciar sesión para gestionar la sesión del usuario
session_start();

// Obtener la conexión
$pdo = conexionPDO();

// Capturar datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

// Preparar consulta segura para obtener la contraseña
$stmt = $pdo->prepare("SELECT id_usuario, contraseña FROM usuarios WHERE nick = :usuario");
$stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$stmt->execute();

// Verificar si el usuario existe
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);  // Obtener la fila de la base de datos

    // Verificar la contraseña
    if (password_verify($contraseña, $row['contraseña'])) {
        // Si la contraseña es correcta, iniciar sesión

//--------------------------------------------------------------

        $_SESSION['usuario'] = $usuario;  // Guardar el usuario en la sesión

//--------------------------------------------------------------

        // Redirigir al menú
        header("Location: ../vista/inicioJuego.php");
        exit(); // Detener el script después de la redirección
    } else {
        // Contraseña incorrecta
        header("Location: ../index.php?error=contraseña");
        exit(); // Detener el script después de la redirección
    }
} else {
    // Usuario no encontrado
    header("Location: ../index.php?error=usuario");
    exit(); // Detener el script después de la redirección
}

?>



