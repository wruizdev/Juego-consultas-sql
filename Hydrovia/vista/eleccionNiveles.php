<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegir Nivel</title>
    <link rel="stylesheet" href="./css/estilos.css">

</head>
<body class="con-fondo">
   
<div class="overlay-naranja">
    <div id="fondo_formulario">
        <!-- Formulario para nueva partida -->
        <!-- <form action="../controlador/constructorDeCapitulo.php" method="post"> -->
        <form action="./capitulo.php" method="post">
            <h1>Elige el nivel de dificultad</h1>
            <button type="submit" name="facil" id="facil" value="facil">Fácil</button>
            <button type="submit" name="medio" id="medio">Medio</button>
            <button type="submit" name="dificil" id="dificil">Difícil</button>
            
    </form>
    </div>
</div>
</body>
</html>
