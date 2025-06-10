<?php
require("../controlador/constructorDeCapitulo.php");
require("../modelo/conexionPDO.php");
require("../controlador/FuncionesDatosJson.php");

$conexion = conexionPDO();



session_start();  // Iniciar la sesión al principio del archivo

$dificultad = "";

//----------------------CARGO LOS DATOS DE LA SESION DEL USUARIO PARA QUE CONTINUE SU PARTIDA-----------------------------------

// $datosSesionRestaurados=restaurarDatosSesion($conexion, $_SESSION["usuario"]);

// $datosDecodificadosJsonDificultadActual = decodificarJson($datosSesionRestaurados);

// $dificultad = $datosDecodificadosJsonDificultadActual["dificultad"];

// $_SESSION['dificultad']=$dificultad;

//print_r($datosSesionRestaurados);


//--------------------------------------------------------------------------------------------------------------------


//-------------------------------LE PASO EL CAPITULO QUE ESTA GUARDADO EN UN FORMULARIO EN ESTA PAGINA.----------------------------------
//--Esta parte hace que el el capitulo sume +1 cuando contestamos bien, y asi me permite cambiar al siguiente capitulo al volver a cargar la misma pagina.
if (isset($_GET['capitulo'])) {
    $id_capitulo = (int)$_GET['capitulo'];
    $_SESSION["capitulo_actual"] = $id_capitulo;
} else {
    $id_capitulo = $_SESSION["capitulo_actual"];
}


//--------------------------------ACTUALIZAR DATOS DE SESION EN CADA RONDA-------------------------------------


$datosCodificadosJsonPuntos_vida = json_encode($_SESSION);
actualizarDatosSesion($conexion, $datosCodificadosJsonPuntos_vida, $_SESSION["usuario"]);

//print_r($_SESSION);//MUESTRO DATOS, se puede quitar.

//echo "CAPITULO NUMERO: " . $_SESSION["capitulo_actual"];

//--------------------------------------------------------------------------------------------------------


$datosCodificadosJsonDificultad; //DECLARO LA VARIABLE.


// Asegurar que la variable de dificultad tenga un valor válido
if (isset($_POST['facil'])) {

    $_SESSION['dificultad'] = 'facil';
    $datosCodificadosJsonDificultad = json_encode($_SESSION);
    actualizarDatosSesion($conexion, $datosCodificadosJsonDificultad, $_SESSION["usuario"]);

    echo "<p id='puntos-vida'><i class='fas fa-heart'></i> {$_SESSION['puntos_vida']}</p>";//HACE QUE SE VEA LA VIDA AL CARGAR LA PAGINA POR PRIMERA VEZ
    echo modal();
} else if (isset($_POST['medio'])) {

    $_SESSION['dificultad'] = 'medio';
    $datosCodificadosJsonDificultad = json_encode($_SESSION);
    actualizarDatosSesion($conexion, $datosCodificadosJsonDificultad, $_SESSION["usuario"]);
    echo "<p id='puntos-vida'><i class='fas fa-heart'></i> {$_SESSION['puntos_vida']}</p>";//HACE QUE SE VEA LA VIDA AL CARGAR LA PAGINA POR PRIMERA VEZ
    echo modal();
} else if (isset($_POST['dificil'])) {

    $_SESSION['dificultad'] = 'dificil';
    $datosCodificadosJsonDificultad = json_encode($_SESSION);
    actualizarDatosSesion($conexion, $datosCodificadosJsonDificultad, $_SESSION["usuario"]);
    echo "<p id='puntos-vida'><i class='fas fa-heart'></i> {$_SESSION['puntos_vida']}</p>";//HACE QUE SE VEA LA VIDA AL CARGAR LA PAGINA POR PRIMERA VEZ
    echo modal();
} else {
    // Si no se ha seleccionado dificultad, usar el valor almacenado en la sesión
    if (isset($_SESSION['dificultad'])) {

        $dificultad = $_SESSION['dificultad']; // Obtener la dificultad de la sesión
        //echo "DIFICULTAD DANDO A CONTINUAR: " . $dificultad . " "; 
        
    }
}
$dificultad = $_SESSION['dificultad'];


// Crear y mostrar la página
$pagina = crearPagina($dificultad, $conexion, $id_capitulo);
echo $pagina;
