<?

//require("../controlador/controladorRegistro.php");

//=====================Declaro las variables de error=========================
$nick = $correo = $nickErr = $correoErr = $contraseñaErr = "";//Solo estamos usando la de nickErr que nos dira si el nick esta repetido en la base de datos.

if ($_SERVER["REQUEST_METHOD"] == "GET") {//Uso GET para un mensaje de error
    if (isset($_GET["nickErr"])) {

        $nickErr = htmlspecialchars($_GET["nickErr"]);

    }if (isset($_GET["correoErr"])) {
        $correoErr = htmlspecialchars($_GET["correoErr"]);
    }
    if (isset($_GET["contraseñaErr"])) {
        $contraseñaErr = htmlspecialchars($_GET["contraseñaErr"]);
    }



}

//==================================================================================================
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>
<body class="con-fondo">

<div class="overlay-naranja">
<div id="fondo_formulario">



    <form method="post" action="../controlador/controladorRegistro.php">
        <h1>Registro</h1>

        <label for="nick">Nick:</label>
        <input type="text" id="nick" name="nick" value="<?php echo $nick; ?>" >
        <span style="color: red;"><?php echo $nickErr; ?></span> <br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" >
        <span style="color: red;"><?php echo $correoErr; ?></span> <br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" value="" >
        <span style="color: red;"><?php echo $contraseñaErr; ?></span> <br>

        <input type="submit" value="Registrarme">
        <p id="ya_tienes_cuenta">¿Ya tienes una cuenta? <a href="../index.php">Inicia sesión aquí</a>

    </form>
  
</div>
</div>
</body>
</html>
