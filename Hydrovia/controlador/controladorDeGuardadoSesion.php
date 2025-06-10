<?
class Sesion
{

    function guardarSesion($conexion)
    {
        

        $datosSerializados = json_encode($_SESSION);
        //echo "<br>" . $datosSerializados;
        // Establecer conexión a la base de datos usando PDO

        // $conexion=conexionPDO();


        // Datos para registrar
        $id_sesion = session_id();

        //echo "<br>" . $id_sesion . "<br>";

        $datosSesion = $datosSerializados;

        //---------------

        $id_usuario = $_SESSION['id_usuario'];      

        //--------------

        date_default_timezone_set('Europe/Madrid');//Zona horaria

        $fechaUltimoAcceso = date("Y-m-d H:i:s"); //Fecha y hora
        

        try {
            // Preparar la consulta
            $sql = "INSERT INTO sesiones (id_usuario, sesion_id_servidor, datos, fecha_ultimo_acceso ) VALUES (:id_usuario, :id_sesion, :datos_sesion, :fecha_ultimo_acceso)";
            $stmt2 = $conexion->prepare($sql);

            // Asignar valores a los parámetros y ejecutar
            $stmt2->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $stmt2->bindParam(':id_sesion', $id_sesion, PDO::PARAM_STR);
            $stmt2->bindParam(':datos_sesion', $datosSesion, PDO::PARAM_STR);
          
            $stmt2->bindParam(':fecha_ultimo_acceso', $fechaUltimoAcceso, PDO::PARAM_STR);

            $stmt2->execute();

            // Verificar si se insertó correctamente
            if ($stmt2->rowCount() > 0) {
                //echo "La sesion ha sido registrada";
            } else {
                echo "La sesion no se ha podido registrar";
            }
        } catch (PDOException $e) {
            echo "Error al registrar la sesion: " . $e->getMessage();
        }

        // Cerrar la conexión (opcional, PDO lo hace automáticamente al finalizar el script)
        $conexion = null;
    }




    function cargarSesion($conexion)
    {

        session_start();

        if (isset($_POST['facil'])) {

            $dificultad = $_POST["facil"];

            echo "La variable \$dificultad está definida y su valor es: " . $dificultad;
        } else {
            echo "La variable \$dificultad no está definida.";
        }

        // Realizando una consulta

        $sql = "SELECT datos FROM sesiones WHERE id_usuario = (SELECT id_usuario FROM usuarios WHERE nick = :nick)";

        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $conexion->prepare($sql);

        $nick = $_SESSION["usuario"];
        $stmt->bindParam(':nick', $nick, PDO::PARAM_STR);

        // Ejecutamos la consulta
        $stmt->execute();

        // Mostrando los resultados
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Los datos del usuario " . $nick . " son: " . $fila['datos'];
        }


        // No es necesario cerrar la conexión explícitamente con PDO, se cierra automáticamente
        $conexion = null;
    }





    function reiniciarValoresJuego()
    {

        require("../modelo/conexionPDO.php");

        session_start();


        if (isset($_POST['facil'])) {

            $dificultad = $_POST["facil"];


        } else if (isset($_POST['medio'])) {
        } else if (isset($_POST['dificil'])) {
        }


        try {
            // Preparar la consulta
            $sql = "INSERT INTO sesiones (id_usuario, sesion_id_servidor, datos, , fecha_ultimo_acceso ) VALUES (:id_usuario, :id_sesion, :datos_sesion, :, :fecha_ultimo_acceso)";
            $stmt2 = $conexion->prepare($sql);

            // Asignar valores a los parámetros y ejecutar
            $stmt2->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
            $stmt2->bindParam(':id_sesion', $id_sesion, PDO::PARAM_STR);
            $stmt2->bindParam(':datos_sesion', $datosSesion, PDO::PARAM_STR);
            $stmt2->bindParam(':', $fechaInicio, PDO::PARAM_STR);
            $stmt2->bindParam(':fecha_ultimo_acceso', $fechaUltimoAcceso, PDO::PARAM_STR);

            $stmt2->execute();

            // Verificar si se insertó correctamente
            if ($stmt2->rowCount() > 0) {
                echo "La sesion ha sido registrada";
            } else {
                echo "La sesion no se ha podido registrar";
            }
        } catch (PDOException $e) {
            echo "Error al registrar la sesion: " . $e->getMessage();
        }

        // Cerrar la conexión (opcional, PDO lo hace automáticamente al finalizar el script)
        $conexion = null;
    }

}
