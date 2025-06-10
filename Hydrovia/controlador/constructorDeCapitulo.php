<?php
//require("../modelo/conexionPDO.php");
//require("./controladorDeGuardadoSesion.php");
//
//$conexion = conexionPDO();



function modal()
{

    $modal = "";

    $modal = " <div class='consultar-btn'>
        <input type='submit' value='Consultar base de datos' onclick='mostrarModal()'/>
    </div>


    <div id='miModal' class='modal'>
        <div class='modal-contenido'>
            <span class='cerrar' onclick=cerrarModal()>&times;</span>
            <img src='../vista/img/imagenBD.png' alt='Base de datos' class='modal-imagen'/>
        </div>
</div>";


    return $modal;
}
function obtenerConsultasErroneasPorCapitulo($dificultad, $conexion, $id_capitulo)
{

    // Inicializar el array fuera del bucle
    $arrayRespuestasErroneas = [];

    try {
        // Preparar la consulta para obtener respuestas erróneas aleatorias.
        $stmtRespuestasErroneas = $conexion->prepare(
            "SELECT id_capitulo, consulta_sql, dificultad FROM consultas_erroneas 
             WHERE id_capitulo = :id_capitulo AND dificultad = :dificultad 
             ORDER BY RAND() 
             LIMIT 2;"
        );

        //$id_capitulo = 1; // Asegúrate de obtener dinámicamente el ID del capítulo si es necesario.
        $stmtRespuestasErroneas->bindParam(':id_capitulo', $id_capitulo, PDO::PARAM_INT);
        $stmtRespuestasErroneas->bindParam(':dificultad', $dificultad, PDO::PARAM_STR);
        $stmtRespuestasErroneas->execute();

        if ($stmtRespuestasErroneas->rowCount() > 0) {



            // Obtener todas las respuestas erróneas en un array.
            $respuestasErroneas = $stmtRespuestasErroneas->fetchAll(PDO::FETCH_ASSOC);

            foreach ($respuestasErroneas as $respuesta) {

                //echo "Respuesta errónea: " . $respuesta['consulta_sql'] . "<br>";

                // Agregar la respuesta al array
                array_push($arrayRespuestasErroneas, $respuesta['consulta_sql']);
            }
        } else {

            echo "No se encontraron respuestas erróneas para el capítulo y dificultad especificados.";
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }


    return $arrayRespuestasErroneas;
}


function obtenerConsultaCorrecta($dificultad, $conexion, $id_capitulo)
{

    $respuestaCorrecta = [];

    try {
        // Preparar la consulta para obtener respuestas erróneas aleatorias.
        $stmtRespuestaCorrecta = $conexion->prepare(
            "SELECT id_capitulo, consulta_sql, dificultad
             FROM consultas_sql_correctas
             WHERE id_capitulo = :id_capitulo AND dificultad = :dificultad;"
        );

        //$id_capitulo = 1; // Asegúrate de obtener dinámicamente el ID del capítulo si es necesario.
        $stmtRespuestaCorrecta->bindParam(':id_capitulo', $id_capitulo, PDO::PARAM_INT);
        $stmtRespuestaCorrecta->bindParam(':dificultad', $dificultad, PDO::PARAM_STR);
        $stmtRespuestaCorrecta->execute();

        if ($stmtRespuestaCorrecta->rowCount() > 0) {
            // Inicializar el array fuera del bucle


            // Obtener todas las respuestas erróneas en un array.
            $arrayTemporal = $stmtRespuestaCorrecta->fetchAll(PDO::FETCH_ASSOC);

            foreach ($arrayTemporal as $respuesta) {


                //---------------------------------------DESCOMENTAR SI SE DESEA MOSTRAR LA RESPUESTA CORRECTA---------------------------------

                //                echo "Respuesta correcta: " . $respuesta['consulta_sql'] . "<br>";


                //-----------------------------------------------------------------------------------------------------

                // Agregar la respuesta al array
                array_push($respuestaCorrecta, $respuesta['consulta_sql']);
            }

            // Recorrer el array después de llenarlo
            // for ($i = 0; $i < count($arrayRespuestasErroneas); $i++) {
            //     echo "Respuestas desde el array: " . $arrayRespuestasErroneas[$i] . "<br>";
            // }

        } else {

            echo "No se encontraron respuestas para el capítulo y dificultad especificados.";
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }

    return $respuestaCorrecta;
}

function vidaRestada($dificultad)
{

    if ($dificultad == "facil") {
        $dificultad = 10;
    } else if ($dificultad == "medio") {
        $dificultad = 20;
    } else if ($dificultad == "dificil") {
        $dificultad = 30;
    } else {

        $dificultad = 50;
    }
    return $dificultad;
}

function selectorImagenes($id_capitulo)
{

    $imagen = "";

    $imagenes = array(
        "../vista/imgCapitulos/capitulo01.png",
        "../vista/imgCapitulos/capitulo02.png",
        "../vista/imgCapitulos/capitulo03.png",
        "../vista/imgCapitulos/capitulo04.png",
        "../vista/imgCapitulos/capitulo05.png",
        "../vista/imgCapitulos/capitulo06.png",
        "../vista/imgCapitulos/capitulo07.png",
        "../vista/imgCapitulos/capitulo08.png",
        "../vista/imgCapitulos/capitulo09.png",
        "../vista/imgCapitulos/capitulo10.png",
        "../vista/imgCapitulos/capitulo11.png",
        "../vista/imgCapitulos/capitulo12.png"
    );
    $imagen = $imagenes[$id_capitulo - 1];
    return $imagen;
}


function selectorTitulos($id_capitulo)
{

    $titulo_capitulo = "";
    $titulos = array(
        "Sed de Venganza",
        "Cruzando la Frontera",
        "Válvulas y Secretos",
        "Aliados en la Oscuridad",
        "La Sala de Control Exterior",
        "La Conspiración de los Ricos",
        "La Torre de las Mareas",
        "El Traidor",
        "Desviando el Flujo",
        "El Ejército del Emperador",
        "La Verdad Oculta",
        "El Enfrentamiento Final"
    );
    $titulo_capitulo = $titulos[$id_capitulo - 1];
    return $titulo_capitulo;
}


function selectorTextos($id_capitulo)
{

    $textos_capitulo = "";
    $textos = array(
        "Ezekiel escucha rumores sobre la ubicación de la sala de control del agua. La base de datos está protegida dentro de la Torre de las Mareas, la fortaleza del Emperador de Bronce. Ezekiel encuentra un mapa incompleto en el mercado negro. Consulta la base de datos mapas para buscar las secciones faltantes que lo lleven a la entrada secreta.",
        "Ezekiel entra en el barrio intermedio, donde un puente de vigilancia separa a los pobres de los ricos. Los guardias verifican identidades en un sistema de control. Hackea la base de datos de identidades para reemplazar su nombre con el de un noble fallecido.",
        "Dentro de la fortaleza, Ezekiel se encuentra con un mecanismo de válvulas que suministra agua a los pobres. Para evitar levantar sospechas, necesita conocer qué válvulas se activarán ese día. Consulta la tabla válvulas para identificar qué sectores recibirán agua.",
        "Ezekiel encuentra a un grupo de trabajadores oprimidos que también buscan liberar el agua. A cambio de información sobre los guardias, necesitan saber qué días tendrán acceso a agua. Realiza una consulta a la tabla suministros para determinar los próximos días de apertura de válvulas.",
        "Ezekiel llega a la primera sala de control, donde los datos de los sectores están parcialmente almacenados. Aquí encuentra registros antiguos. Elimina los registros obsoletos para liberar espacio y evitar errores en las válvulas.",
        "Ezekiel descubre un documento que revela que los ricos están desviando agua para experimentos secretos. Consulta la base de datos proyectos para identificar los experimentos relacionados con el agua.",
        "En la Torre de las Mareas, Ezekiel se encuentra con un sistema que monitorea en tiempo real las válvulas activas. Identifica qué válvulas están abiertas y reconfigúralas para que suministren agua a los sectores pobres.",
        "Ezekiel descubre que un líder de los trabajadores está colaborando con los ricos a cambio de agua extra. Busca en la base de datos de transacciones evidencia de corrupción para exponer al traidor.",
        "Ezekiel logra acceder a un sistema de emergencia que permite reconfigurar las rutas del agua. Redirige el flujo de agua desde los barrios ricos a los pobres.",
        "Los ricos envían un ejército de autómatas para detener a Ezekiel. Hackea la tabla automatizacion para desactivar las máquinas.",
        "Ezekiel encuentra registros que revelan que las reservas de agua son mucho mayores de lo que los ricos dicen. Consulta la base de datos reservas para calcular cuánta agua se ha ocultado al pueblo.",
        "Ezekiel llega a la sala principal donde el Emperador controla todo el sistema. Solo una consulta correcta puede liberar el agua. Configura todas las válvulas para abrirse y liberar el agua para siempre."
    );

    $textos_capitulo = $textos[$id_capitulo - 1];
    return $textos_capitulo;
}


function crearPagina($dificultad, $conexion, $id_capitulo)
{
    $imagen = selectorImagenes($id_capitulo);

    $datosActualizados = restaurarDatosSesion($conexion, $_SESSION["usuario"]);

    $datosDecodificadosJsonVidaActual = decodificarJson($datosActualizados);

    $puntosDeVidaMostrados = $datosDecodificadosJsonVidaActual["puntos_vida"];


    //------------------------------------------RESPUESTAS--------------------------------------------------------------

    // Obtener respuestas
    $arrayRespuestasErroneas = obtenerConsultasErroneasPorCapitulo($dificultad, $conexion, $id_capitulo);
    $arrayRespuestaCorrecta = obtenerConsultaCorrecta($dificultad, $conexion, $id_capitulo);

    // Meto las respuestas erroneas al array $opciones
    $opciones = $arrayRespuestasErroneas;

    // Meto la respuesta correcta al array $opciones
    array_push($opciones, $arrayRespuestaCorrecta[0]);

    // Barajar las opciones
    shuffle($opciones);
    $titulo = selectorTitulos($id_capitulo);
    $texto = selectorTextos($id_capitulo);


    //------------------------------------------------ HTML inicial usando HEREDOC------------------------------------------------


    $html = <<<HTML

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capítulo $id_capitulo - Nivel $dificultad</title>
     <link rel="stylesheet" href="../vista/css/estilos.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body class="sin-fondo">
<div id="contenedor_formulario">
    <div id="contenedor_mision">

<div id="contenedor_menu_superior">
   <div id="casa_nivel">
          <!-- Icono de salir como enlace -->
            <a href="../vista/inicioJuego.php" class="icono-salir" title="Ir a la página de inicio">
                <i class="fas fa-home"></i> <!-- Icono de casa -->
            </a>
                        <p> Nivel: $dificultad   </p>
            </div>
       <!-- Modal ------------------------------------------------------------------------------------>
         <!-- Botón Consultar base de datos -->
            <div class="consultar-btn">
                <input type="submit" value="Consultar base de datos" onclick="mostrarModal()"/>
            </div>
        
        <!-- Modal -->
            <div id="miModal" class="modal">
                <div class="modal-contenido">
                    <span class="cerrar" onclick="cerrarModal()">&times;</span>
                    <img src="../vista/img/imagenBD.png" alt="Base de datos" class="modal-imagen"/>
                </div>
        </div>
        </div>
        
      <!------------------------------------------------------------------------------------->

            
        <h1 id="titulo_mision">Capítulo $id_capitulo: $titulo </h1>
         <p id="parrafo_mision">
         $texto <br>
         <br>  
        
         </p>
      
        <!-- ACTUALIZAR CORRECTAENTE DESDE LA BASE DE DATOS -->
      

                     <h3 id="subtitulo_consultas">Elige la consulta correcta</h3>

HTML;

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo "<p id='puntos-vida'><i class='fas fa-heart'></i> $puntosDeVidaMostrados</p>";
        echo modal();
        echo "<p>Puntos de vida: {$_SESSION['puntos_vida']}</p>";
    }


    // Procesar el envío del formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['respuesta'])) {
        $respuesta_usuario = $_POST['respuesta'];


        // Verificar si la respuesta es incorrecta
        if ($respuesta_usuario !== $arrayRespuestaCorrecta[0]) {

            // Restar puntos de puntos_vida por una respuesta incorrecta
            $_SESSION['puntos_vida'] -= vidaRestada($dificultad); // FUNCION QUE RESTA VIDA EN FUNCION DE LA DIFICULTAD ELEGIDA.

            //----------------------------ACTUALIZAR DATOS EN LA BASE DE DATOS JSON-------------------------------



            $_SESSION["capitulo_actual"] = $id_capitulo;
            $datosCodificadosJsonPuntos_vida = json_encode($_SESSION);
            //echo "Estoy enviando: ".$datosCodificadosJsonDificultad;

            actualizarDatosSesion($conexion, $datosCodificadosJsonPuntos_vida, $_SESSION["usuario"]);


            //--------------------------------------Traer datos actualizados base datos--------------------------------------------------------------
            $datosActualizados = restaurarDatosSesion($conexion, $_SESSION["usuario"]);

            $datosDecodificadosJsonVidaActual = decodificarJson($datosActualizados);

            $puntosDeVidaMostrados = $datosDecodificadosJsonVidaActual["puntos_vida"];


            //--------------------------------------------------------------------------------------------------


            // Verificar si puntos_vida llegó a 0
            // if ($_SESSION['puntos_vida'] <= 0) {

            if ($puntosDeVidaMostrados <= 0) {
                // Si los puntos llegan a 0, redirigir a una página externa
                header("Location: ./juegoPerdido.php");
                exit();
            }

            $html .= <<<HTML

            <!-- MICHAEL -->
            <p id="puntos-vida"><i class="fas fa-heart"></i> $puntosDeVidaMostrados</p>

            
            <form method="POST">
HTML;
            $html .= <<<HTML

HTML;

            foreach ($opciones as $index => $opcion) {
                $html .= <<<HTML

                    <div>
                        <input type="radio" id="opcion$index" name="respuesta" value="$opcion" required>
                        <label for="opcion$index">$opcion </label> 
                    </div>                         

HTML;
            }
            $html .= <<<HTML
                <button type="submit">Aceptar</button>
                            <p class="mensaje-error">Respuesta incorrecta. Te quedan {$puntosDeVidaMostrados} puntos de vida</p>


                            <div class="consultar-btn">
                <input type="submit" value="Consultar base de datos" onclick="mostrarModal()"/>
            </div>

            </form>

            

            </div>
            </div>
            




HTML;
        } else {
            if ($id_capitulo === 12) {
                // Si es el capítulo final, redirigir a otra página
                $html .= <<<HTML

                <form method="GET" action="juegoCompletado.php">
                <input type="hidden" name="dificultad" value=$dificultad>
                
                    <button type="submit">Ir a la página final</button>
                </form>
HTML;
            } else {


                $_SESSION["capitulo_actual"] = $id_capitulo;
                $datosCodificadosJsonPuntos_vida = json_encode($_SESSION);
                //echo "Estoy enviando: ".$datosCodificadosJsonDificultad;

                actualizarDatosSesion($conexion, $datosCodificadosJsonPuntos_vida, $_SESSION["usuario"]);


                // Si no es el capítulo final, ofrecer avanzar al siguiente capítulo
                $nuevo_capitulo = $id_capitulo + 1;

                $html .= <<<HTML
                <p id="respuesta_correcta">¡Respuesta correcta!</p>

                <p id="puntos-vida"><i class="fas fa-heart"></i> $puntosDeVidaMostrados</p>

                <div class="consultar-btn">
                <input type="submit" value="Consultar base de datos" onclick="mostrarModal()"/>
            </div>
        
        <!-- Modal -->
            <!-- <div id="miModal" class="modal">
                <div class="modal-contenido">
                    <span class="cerrar" onclick="cerrarModal()">&times;</span>
                    <img src="../vista/img/imagenBD.png" alt="Base de datos" class="modal-imagen"/>
                </div>
        </div> -->




                <!-- USO GET PARA ENVIAR EL DATO DEL CAPITULO ACTUAL + 1 PARA QUE AL RECARGAR ESTA PAGINA SE EJECUTE EL CAPITULO SIGUIENTE -->
                <form method="GET">
                    <input type="hidden" name="capitulo" value="$nuevo_capitulo">

                        <!--echo $puntosDeVidaMostrados;-->

        <button type="submit" class="boton-animado">Continuar a Capítulo $nuevo_capitulo</button>
                </form>
HTML;
            }
        }
    } else {
        // Mostrar el formulario inicial
        $html .= '<form method="POST">';
        foreach ($opciones as $index => $opcion) {
            $html .= <<<HTML
                <div>
                    <input type="radio" id="opcion$index" name="respuesta" value="$opcion" required>
                    <label for="opcion$index">$opcion</label>
                </div>
HTML;
        }
        $html .= <<<HTML
             <button type="submit" id="btn_enviar">Aceptar                
</button>
             </form>
        </div>               

HTML;
    }

    // Cerrar HTML
    $html .= <<<HTML
    </div>
      
      <div id="contenedor_imagen">
        <img src=$imagen alt="Imagen del capítulo $id_capitulo"  width="300" height="200">
    </div>

    <script src="../vista/js/modal.js"></script>
</body>
</html>
HTML;

    return $html;
}




