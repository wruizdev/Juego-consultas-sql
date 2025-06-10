<?
require("../modelo/conexionPDO.php");
require("../controlador/FuncionesDatosJson.php");
//Este es un ejemplo. TODO ES FUNCIONAL
$conexion = conexionPDO();
//Me creo una variable porque ya lo tengo metido en la base de datos con mi nombre
$nick = 'Hunter';
//Recupero los datos y los almaceno en una variable
$datosrecuperados = restaurarDatosSesion($conexion, $nick);
//Los muestro en formato JSON
echo "Estos son los datos del json: " . $datosrecuperados . "<br>" . "<br>";
//Decodifico el JSON
$datosDecodificados = decodificarJson($datosrecuperados);
//Prueba que muestra los datos decodificados uno a uno
echo "MUESTRO LOS DATOS DECODIFICADOS" . "<br>";
echo "id_usuario: " . $datosDecodificados['id_usuario'] . "<br>";
echo "capitulo_actual: " . $datosDecodificados['capitulo_actual'] . "<br>";
echo "puntos_vida: " . $datosDecodificados['puntos_vida'] . "<br>" . "<br>";
//Prueba de almacenar los datos decodificados en variables
$id_usuario = $datosDecodificados['id_usuario'];
$capitulo = $datosDecodificados['capitulo_actual'];
$puntos_vida = $datosDecodificados['puntos_vida'];

//ME creo una sesion de prueba y le voy a pasar los datos
session_start();
//Creo las variables de sesion
$_SESSION['id_usuario'] = $id_usuario;
$_SESSION['capitulo_actual'] = $capitulo;
$_SESSION['puntos_vida'] = $puntos_vida;

//Saco por pantalla las variables de sesion para ver que si almaceno las variables
echo "AHORA LO QUE SE IMPRIME ES DIRECTAMENTE DE LAS VARIABLES DE SESION" . "<br>";

echo "id_usuario: " . $_SESSION['id_usuario'] . "<br>";
echo "capitulo: " . $_SESSION['capitulo_actual'] . "<br>";
echo "puntos_vida: " . $_SESSION['puntos_vida'] . "<br>" . "<br>";

/////////////////////////////////
//Ahora voy a probar a actualizar los datos de la sesion en la BBDD
$nivelDificultad = "Medio";
$_SESSION['nivel_dificultad'] = $nivelDificultad;
$_SESSION['saludo'] = "holaBB";
//unset($_SESSION['saludo']); //Esto se usa para eliminar una variable de sesion. El procedimiento en este codigo sería primero descomentar esta linea y comentar la anterior
//Empaquetamos los datos
$datosCodificados = json_encode($_SESSION);
echo "JSON que se está guardando: " . $datosCodificados . "<br>";

echo "VAMOS A ACTUALIZAR LOS DATOS ENVIANDO EL NIVEL DE DIFICULTAD" . "<br>";
actualizarDatosSesion($conexion, $datosCodificados, $nick);

//Voy a mostrar los datos nuevamente decodificados
echo "VOY A DECODIFICAR NUEVAMENTE LOS DATOS. DEBERÍA HABERSE METIDO EL NIVEL DE DIFICULTAD Y SE ACTUALIZARÁ TANTO ARRIBA EN EL JSON COMO EN SALIDA DE ABAJO" . "<br>";
$datosNuevamenteRecuperados = restaurarDatosSesion($conexion, $nick);
echo "JSON que se está recuperando: " . $datosNuevamenteRecuperados . "<br>";

$datosNuevamenteDecodificados = decodificarJson($datosNuevamenteRecuperados);
echo "ID_USUARIO: " . $datosNuevamenteDecodificados['id_usuario'] . "<br>";
echo "CAPITULO: " . $datosNuevamenteDecodificados['capitulo_actual'] . "<br>";
echo "PUNTOS DE VIDA: " . $datosNuevamenteDecodificados['puntos_vida'] . "<br>";
echo "NIVEL DE DIFICULTAD: " . $datosNuevamenteDecodificados['nivel_dificultad'] . "<br>";
