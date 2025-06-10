
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego no completado</title>
    <link rel="stylesheet" href="./css/estilos.css">

</head>
<body class="con-fondo3">

<?php
if(isset($_POST["volver_jugar_derrota"])) {
    header("Location: ./inicioJuego.php");
}

//if(isset($_POST["historial"])) {
//    header("Location: historial.php");
//}
?>



<div class="overlay-naranja">
<!--    <div id="fondo_formulario4">-->
        <!-- Formulario para nueva partida -->
        <form id="form-juego-perdido" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h1> Lo siento, no has logrado completar el juego... </h1>
            <p id="mensaje_juego_perdido">Recuerda que no todo está perdido. Puedes intentarlo de nuevo, mejorar tus habilidades,
                y demostrar que estás listo para afrontar cualquier desafío. </p> <br>

            <!-- Imagen ? -->
            <div id="foto_derrota">
<!--                <img src='../vista/img/derrota.jpg' alt='Derrota' width="300" height="200">-->
            </div>


            <button type="submit" name="volver_jugar_derrota" id="volver_jugar_derrota">Volver a jugar</button>
<!--            <button type="submit" name="historial" id="historial">Ver historial</button>-->

        </form>
    </div>
<!--</div>-->
</body>
</html>

