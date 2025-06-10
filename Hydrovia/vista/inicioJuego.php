<?
//---------------------------Recuparando los datos de la sesion del usuario actual del archivo JSON guardado en la base de datos -----------------------------------------------

require("../modelo/conexionPDO.php");
require("../controlador/FuncionesDatosJson.php");



session_start();



//---------------------------------------------------------------------------
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body class="con-fondo">

    <?php
    if (isset($_POST["nuevaPartida"])) {

        $pdo = conexionPDO();
        $nickUsuario = $_SESSION['usuario'];
        $datosJsonDelUsuario = restaurarDatosSesion($pdo, $nickUsuario);

        //echo $datosJsonDelUsuario;

        $datosJsonDescomprimidos = decodificarJson($datosJsonDelUsuario);

        //print_r($datosJsonDescomprimidos);

        $_SESSION["id_usuario"] = $datosJsonDescomprimidos["id_usuario"];
        $_SESSION["capitulo_actual"] = $datosJsonDescomprimidos["capitulo_actual"];
        $_SESSION["capitulo_actual"] = 1;
        $_SESSION["puntos_vida"] = $datosJsonDescomprimidos["puntos_vida"];
        $_SESSION["puntos_vida"] = 100;   // PONER LA VIDA A 100

        //header("Location: eleccionNiveles.php");
        header("Location: ./capitulo0.php");

    } else if (isset($_POST["continuarPartida"])) {

        $pdo = conexionPDO();
        $nickUsuario = $_SESSION['usuario'];
        $datosJsonDelUsuario = restaurarDatosSesion($pdo, $nickUsuario);

        //echo $datosJsonDelUsuario;

        $datosJsonDescomprimidos = decodificarJson($datosJsonDelUsuario);

        $_SESSION["id_usuario"] = $datosJsonDescomprimidos["id_usuario"];
        $_SESSION["capitulo_actual"] = $datosJsonDescomprimidos["capitulo_actual"];
        $_SESSION["puntos_vida"] = $datosJsonDescomprimidos["puntos_vida"];
        $_SESSION["dificultad"] = $datosJsonDescomprimidos["dificultad"];
        // $_SESSION["puntos_vida"] = 100;   // PONER LA VIDA A 100



        header("Location: capitulo.php");
    }

    ?>
    <div class="overlay-naranja">
        <div id="fondo_formulario">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h1>¡Bienvenido al Juego!</h1>
                <p id="que_te_gustaria_hacer">¿Qué te gustaría hacer? </p>

                <?php    //HOLA AMIGOS. Aquí he vuelto a instanciar un objeto de tipo conexion porque se necesita    //Como se supone que la base de datos siempre se actualiza, primero extreamos los datos del JSON y los decodificamos    //Para ello hemos usado las funciones existentes    //La logica para permitir continuar el juego o no vendrá determinado de los datos del JSON porque guarda todo el    //contenido de las variables de SESSION. Entonces lo que hacemos es verificar si existe o no esa variable en los    //datos decodificados del JSON que es un array asociativo    //En el caso de la dificultad se comprueba si existe en ese array y    //Y en el caso de los puntos de vida se comprueba que los puntos de vida siempre sean mayores que 0 para continuar partida. 
                $pdo = conexionPDO();
                $datosExtraidos = restaurarDatosSesion($pdo, $_SESSION["usuario"]);
                $datosDecodificados = decodificarJson($datosExtraidos);
                if (!isset($datosDecodificados["dificultad"]) || $datosDecodificados["puntos_vida"] <= 0) {

                    echo "<button type='submit' name='nuevaPartida' id='nuevaPartida'>Jugar nueva Partida</button>";

                    echo"<p id='ya_tienes_cuenta'><a href='../index.php'>Salir</a>";

                } else {

                    echo "<button type='submit' name='nuevaPartida' id='nuevaPartida'>Jugar nueva Partida</button>";
                    echo "<button type='submit' name='continuarPartida' id='continuarPartida'>Continuar Partida</button>";
                    echo"<p id='ya_tienes_cuenta'><a href='../index.php'>Salir</a>";

                } ?>

                




            </form>
        </div>
    </div>
</body>

</html>