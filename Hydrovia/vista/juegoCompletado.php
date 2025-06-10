
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego completado</title>
    <link rel="stylesheet" href="./css/estilos.css">

</head>
<body class="con-fondo">

<?php
if(isset($_POST["volver_jugar"])) {
    header("Location: inicioJuego.php");
}
//if(isset($_POST["historial"])) {
//    header("Location: historial.php");
//}

?>


<div class="overlay-naranja">
    <div id="fondo_formulario">
        <!-- Formulario para nueva partida -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h1> 🎉 ¡Enhorabuena, has completado el juego! 🎉</h1>
            <p id="mensaje_juego_completado">Has completado todas las consultas con éxito y has alcanzado el objetivo del juego: restaurar el sistema y
                salvar a la población.</p> <br>

            <!-- Imagen ? -->
            <button type="submit" name="volver_jugar" id="volver_jugar">Volver a jugar</button>

        </form>
    </div>
</div>
</body>
</html>


