<?

if (isset($_POST["empezar"])) {


    //header("Location: eleccionNiveles.php");
    header("Location: ./eleccionNiveles.php");
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introducción</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <style>
        /* Estilos básicos para el párrafo */
        #parrafo_capitulo0 {
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }
    </style>
</head>

<body class="con-fondo2">
<div class="overlay-naranja">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div id="fondo_formulario3">
            <h1 id="titulo_capitulo0">Introducción</h1>
            <p id="parrafo_capitulo0"></p>
            <button type="submit" name="empezar" id="empezar">Comenzar</button>
        </div>
    </form>
</div>

<!-- Se incluye el script externo -->
<script src="./js/efectoTextoCap0.js"></script>
</body>

</html>

