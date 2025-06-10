<?php


session_start(); // Inicia la sesión

session_unset();

// Suponemos que al iniciar sesión, el servidor guarda información del usuario en la variable de sesión
// Verificamos si el usuario está conectado
$usuarioConectado = isset($_SESSION['usuario']) && !empty($_SESSION['usuario']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="./vista/css/estilos.css">
</head>
<body class="con-fondo">
<div class="overlay-naranja">
<div id="fondo_formulario">

    <form action="./controlador/ingresar.php" method="post" name="frm">
<!-- Funciona pero se puede mejorar los mensajes de error -->
    
<?php
    if (isset($_GET['error'])) {

        if ($_GET['error'] == 'usuario') {

            echo '<p style="color: red;">Usuario no encontrado.</p>';
            
    } elseif ($_GET['error'] == 'contraseña') {

        echo '<p style="color: red;">Contraseña incorrecta.</p>';
    }
}

?>

        <h1>Inicio de Sesión</h1>
        <label class="etiqueta" for="usuario">Usuario:</label>
        <input id="usuario" type="text" name="usuario" class="campo">

        <br> 

        <label class="etiqueta" for="contraseña">Contraseña:</label>
        <input id="contraseña" type="password" name="contraseña" class="campo">
        <br>

        <input type="submit" value="Iniciar Sesión" />

        <p id="aun_no_tienes_cuenta">¿Aún no tienes cuenta? <a href="./vista/formularioRegistro.php">Regístrate aquí</a>

    </form>
    </div>
</div>
</body>
</html>

