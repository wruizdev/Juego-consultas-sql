<?php
//Esta función recibe un objeto tipo conexion y el nombre del usuario o nick
function restaurarDatosSesion($conexion, $nickUsuario){
    try{
    $sql = "SELECT datos FROM sesiones WHERE id_usuario =(SELECT id_usuario FROM usuarios WHERE nick=:nickUsuario)";
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nickUsuario', $nickUsuario, PDO::PARAM_STR);
    $stmt->execute();

    // Mostrando los resultados
    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $datosSesion = $fila['datos'];
    }
}catch(PDOException $e){
    error_log("Error al restaurar la sesión: " . $e->getMessage());
}

    $conexion = null;

    return $datosSesion;
}

//Recibe una variable con los datos de la Sesion en JSON y devuelve un array asociativo con los datos 
function decodificarJson($datosSesion){

    if($datosSesion!==null){
        $datosDecodificados = json_decode($datosSesion,true);
    }else{
        echo "No hay nada en el JSON";
    }
    

    return $datosDecodificados;
}


function actualizarDatosSesion($conexion, $datosCodificados ,$nickUsuario){
    //session_start();
    //ESTO SE PUEDE HACER TAMBIEN. EN LUGAR DE PASAR LOS DATOS PASAS EL NIVEL DE DIFICULTAD
    //$_SESSION['nivel_dificultad']=$nivelElegido;
    //$_SESSION['saludoPrueba']="holaBB";

    

    try {
        // Preparar la consulta SQL para actualizar
        $sql = "UPDATE sesiones SET datos = :datos WHERE id_usuario =(SELECT id_usuario FROM usuarios WHERE nick=:nickUsuario LIMIT 1)";
        
        // Preparar la declaración
        $stmt = $conexion->prepare($sql);
        
        // Enlazar los valores
        $stmt->bindParam(':datos', $datosCodificados, PDO::PARAM_STR);
        $stmt->bindParam(':nickUsuario', $nickUsuario, PDO::PARAM_STR);
        
        // Ejecutar la consulta
        $resultado = $stmt->execute();
        
        // Verificar si se realizó la actualización
        if ($resultado) {
            //echo "Registro actualizado correctamente"."<br>";
        } else {
            echo "No se pudo actualizar el registro"."<br>";
        }
    } catch (PDOException $e) {
        // Manejo de errores
        echo "Error al actualizar el registro: " . $e->getMessage();
    }
}

?>