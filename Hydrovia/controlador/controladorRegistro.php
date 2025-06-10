<?php

require("../modelo/conexionPDO.php");
require("../controlador/controladorDeGuardadoSesion.php");

// Variables para almacenar errores y valores de los campos
$nick = $correo = $contraseña = "";
$nickErr = $correoErr = $contraseñaErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validar Nick
  if (empty($_POST["nick"])) {
    $nickErr = "El nick es obligatorio";
  } else {


    $nick = htmlspecialchars($_POST["nick"]);


    //========================= Comprobar si el nick ya existe en la base de datos===================================

    $conexion1 = conexionPDO(); // Asegúrate de tener acceso a la conexión aquí
    $stmtNick = $conexion1->prepare("SELECT COUNT(*) FROM usuarios WHERE nick = :nick");
    $stmtNick->bindParam(':nick', $nick, PDO::PARAM_STR);
    $stmtNick->execute();
    $nickCount = $stmtNick->fetchColumn();


    if ($nickCount > 0) {

      $nickErr = "El nick ya está en uso, por favor elige otro.";



      //====================================================================================================

    }
  }

  // Validar Contraseña
  if (empty($_POST["contraseña"])) {
    $contraseñaErr = "La contraseña es obligatoria";
  } else {
    $contraseña = htmlspecialchars($_POST["contraseña"]);
  }

  // Validar Correo
  if (empty($_POST["correo"])) {
    $correoErr = "El correo es obligatorio";
  } elseif (!filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL)) {
    $correoErr = "Formato de correo no válido";
  } else {
    $correo = htmlspecialchars($_POST["correo"]);
  }

  if (!empty($nickErr) || !empty($contraseñaErr) || !empty($correoErr)) {
    //Uso "urlencode" para enviar datos por el métodos GET: Al incluir datos en una solicitud GET para evitar problemas con caracteres especiales.

  
    header("Location: ../vista/formularioRegistro.php?nickErr=" . urlencode($nickErr) . "&correoErr=" . urlencode($correoErr) . "&contraseñaErr=" . urlencode($contraseñaErr));
    exit();
  }





  // Si no hay errores, procesar los datos
  if (empty($nickErr) && empty($contraseñaErr) && empty($correoErr)) {


    if (empty($nickErr) && empty($contraseñaErr) && empty($correoErr)) {

      $conexion = conexionPDO();

      $stmt = $conexion->prepare("INSERT INTO usuarios (nick, contraseña, correo) VALUES (?, ?, ?)");

      $stmt->execute([$nick, password_hash($contraseña, PASSWORD_DEFAULT), $correo]);


      //sesion---------------Obtener ID_USUARIO de la base de datos-----------------------------------
      session_start();

      $stmt1 = $conexion->prepare("SELECT id_usuario, capitulo_actual, puntos_vida from usuarios WHERE nick = :usuario");

      $stmt1->bindParam(':usuario', $nick, PDO::PARAM_STR);
      $stmt1->execute();

      if ($stmt1->rowCount() > 0) {
        $row = $stmt1->fetch(PDO::FETCH_ASSOC);  // Obtener la fila de la base de datos
        $id_usuario = $row['id_usuario'];
        //echo "ID USUARIO: ". $id_usuario;

        $capitulo_actual = $row['capitulo_actual'];
        //echo "CAPITULO ACTUAL: ". $capitulo_actual;

        $puntos_vida = $row['puntos_vida'];
        //echo "PUNTOS DE VIDA: ". $puntos_vida;
      }
      //--------------------------Asignar ID_USUARIO a la sesion----------------------------------------

      $_SESSION['id_usuario'] = $id_usuario;

      $_SESSION['capitulo_actual'] = $capitulo_actual;

      $_SESSION['puntos_vida'] = $puntos_vida;



      //-------------------funcion guardar sesion---------------------------

      $sesion = new Sesion();

      $sesion->guardarSesion($conexion);


      //____________________________________________________________

      //Tras registrarse de forma exitosa se carga un html que contiene el mensaje de Registro exitoso
      echo "<!DOCTYPE html>
           <html lang='en'>
           <head>
             <meta charset='UTF-8'>
             <meta name='viewport' content='width=device-width, initial-scale=1.0'>
             <title>Registro Exitoso</title>
             <style>
               body {
                 margin: 0;
                 padding: 0;
                 display: flex; /* Flexbox para centrar el contenido */
                 justify-content: center; /* Centrar horizontalmente */
                 align-items: center; /* Centrar verticalmente */
                 height: 100vh; /* Ocupa toda la altura de la pantalla */
                 background-color: #ffeed4; /* Fondo general de la página */
                 font-family: 'Mabry Pro', sans-serif;
               }
           
               .contenedorMensajeRegistro {
                 background-color:  #e3b75a; /* Oscuro para la caja del mensaje */
                 color: #0d0e0e; /* Texto negro */
                 border: 1px solid; /* Borde verde */
                 border-radius: 25px; /* Bordes redondeados */
                 padding: 20px 30px; /* Espaciado interno */
                 text-align: center; /* Centra el texto */
                 box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
                 max-width: 400px; /* Ancho máximo del recuadro */
                 width: 100%; /* Ancho ajustable */
               }
           
               .contenedorMensajeRegistro h1 {
                 font-size: 24px; /* Tamaño del título */
                 margin-bottom: 10px; /* Espaciado inferior */
               }
           
               .contenedorMensajeRegistro p {
                 font-size: 16px; /* Tamaño del texto */
                 margin: 0; /* Sin margen adicional */
               }
             </style>
           </head>
           <body>
             <div class='contenedorMensajeRegistro'>
               <h1>¡Registro exitoso!</h1>
             </div>
           </body>
           </html>
           ";
      //Se ejecuta el script para redirigir en 3 segundos a index.php y conseguir que el usuario se logee

      //echo "<h3>Registro exitoso</h3>";
      echo "<script>setTimeout(function(){ window.location.href = '../index.php'; }, 3000);</script>";
      exit();
    }
  }
}
