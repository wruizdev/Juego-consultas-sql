CREATE DATABASE IF NOT EXISTS bd_reto DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE bd_reto;

-- Tabla 1: capitulos
CREATE TABLE capitulos (
    id_capitulo INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT
);

-- Tabla 2: usuarios
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nick VARCHAR(50) UNIQUE NOT NULL,
    correo VARCHAR(100) NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    capitulo_actual INT DEFAULT 1,
    puntos_vida INT DEFAULT 100,
FOREIGN KEY(capitulo_actual) REFERENCES capitulos(id_capitulo) ON DELETE CASCADE ON UPDATE CASCADE

);
 
-- Tabla 3: sesiones
CREATE TABLE sesiones (
    id_sesion INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    sesion_id_servidor VARCHAR(255) NOT NULL,
    datos TEXT NOT NULL,
    fecha_ultimo_acceso DATETIME NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
 

 
-- Tabla 4: consultas_sql_correctas
CREATE TABLE consultas_sql_correctas (
    id_consulta INT PRIMARY KEY AUTO_INCREMENT,
    id_capitulo INT NOT NULL,
    consulta_sql TEXT NOT NULL,
    respuesta_correcta TEXT NOT NULL,
    dificultad ENUM('Facil', 'Medio', 'Dificil'),
    FOREIGN KEY(id_capitulo) REFERENCES capitulos(id_capitulo) ON DELETE CASCADE ON UPDATE CASCADE
);
 
-- Tabla 5: consultas_erroneas

CREATE TABLE consultas_erroneas (
    id_capitulo INT,
    consulta_sql TEXT,
	 error_descripcion TEXT,
    dificultad ENUM('Facil', 'Medio', 'Dificil'),
FOREIGN KEY(id_capitulo) REFERENCES capitulos(id_capitulo) ON DELETE CASCADE ON UPDATE CASCADE

);



INSERT INTO capitulos (titulo, descripcion) VALUES
('Sed de Venganza', 'Este es el capitulo 1'),
('Cruzando la Frontera', 'Este es el capitulo 2'),
('Válvulas y Secretos', 'Este es el capitulo 3'),
('Aliados en la Oscuridad', 'Este es el capitulo 4'),
('La Sala de Control Exterior', 'Este es el capitulo 5'),
('La Conspiración de los Ricos', 'Este es el capitulo 6'),
('La Torre de las Mareas', 'Este es el capitulo 7'),
('El Traidor', 'Este es el capitulo 8'),
('Desviando el Flujo', 'Este es el capitulo 9'),
('El Ejército del Emperador', 'Este es el capitulo 10'),
('La Verdad Oculta', 'Este es el capitulo 11'),
('El Enfrentamiento Final', 'Este es el capitulo 12');





INSERT INTO consultas_sql_correctas (id_capitulo, consulta_sql, respuesta_correcta, dificultad) VALUES
-- Capítulo 1: Sed de Venganza
(1, 'SELECT * FROM mapas WHERE fortaleza = ''Torre de las Mareas'';', 'Consultar todos los mapas asociados a la fortaleza Torre de las Mareas.', 'fácil'),
(1, 'SELECT seccion, descripcion FROM mapas WHERE tipo = ''entrada secreta'';', 'Obtener las secciones y descripciones de mapas clasificados como entrada secreta.', 'medio'),
(1, 'SELECT COUNT(*) AS total_mapas FROM mapas WHERE fortaleza = ''Torre de las Mareas'';', 'Contar la cantidad total de mapas relacionados con la fortaleza Torre de las Mareas.', 'difícil'),

-- Capítulo 2: Cruzando la Frontera
(2, 'SELECT * FROM identidades;', 'Consultar todas las identidades.', 'fácil'),
(2, 'INSERT INTO identidades (nombre, clase, status) VALUES (''Fallecido Noble'', ''noble'', ''inactivo'');', 'Insertar una identidad de un noble fallecido como inactivo.', 'medio'),
(2, 'UPDATE identidades SET status = ''activo'', clase = ''noble'' WHERE nombre = ''Ezekiel'' AND id = 1;', 'Actualizar la identidad de Ezekiel para que sea un noble activo.', 'difícil'),

-- Capítulo 3: Válvulas y Secretos
(3, 'SELECT sector, tiempo_apertura FROM valvulas WHERE fecha = ''2024-11-25'';', 'Consultar los sectores y horarios de apertura de las válvulas para el 25 de noviembre de 2024.', 'fácil'),
(3, 'SELECT * FROM valvulas WHERE estado = ''activa'' AND fecha = CURDATE();', 'Obtener todas las válvulas activas en la fecha actual.', 'medio'),
(3, 'SELECT DISTINCT sector FROM valvulas WHERE estado = ''inactiva'';', 'Listar los sectores que tienen válvulas inactivas.', 'difícil'),

-- Capítulo 4: Aliados en la Oscuridad
(4, 'SELECT fecha FROM suministros WHERE sector_id = (SELECT id FROM sectores WHERE nombre = ''trabajadores'');', 'Obtener las fechas de suministro de agua para los trabajadores.', 'fácil'),
(4, 'SELECT fecha, cantidad FROM suministros WHERE sector_id = (SELECT id FROM sectores WHERE nombre = ''barrios pobres'');', 'Obtener la fecha de suministro de agua en los barrios pobres.', 'medio'),
(4, 'INSERT INTO suministros (sector_id, fecha, cantidad) VALUES ((SELECT id FROM sectores WHERE nombre = ''trabajadores''), CURDATE(), 1000);', 'Insertar un suministro de agua para los trabajadores el día de hoy con una cantidad de 1000.', 'difícil'),

-- Capítulo 5: La Sala de Control Exterior
(5, 'DELETE FROM registros WHERE fecha < ''2023-01-01'';', 'Eliminar todos los registros anteriores al 1 de enero de 2023.', 'fácil'),
(5, 'SELECT * FROM registros WHERE fecha BETWEEN ''2023-01-01'' AND ''2024-01-01'';', 'Consultar los registros que se encuentren entre el 1 de enero de 2023 y el 1 de enero de 2024.', 'medio'),
(5, 'UPDATE registros SET estado = ''archivado'' WHERE fecha < ''2023-01-01'';', 'Actualizar el estado de registros anteriores al 1 de enero de 2023 a archivado.', 'difícil'),

-- Capítulo 6: La Conspiración de los Ricos
(6, 'SELECT nombre, recursos FROM proyectos WHERE tipo = ''agua'';', 'Consultar los nombres y recursos de proyectos relacionados con el agua.', 'fácil'),
(6, 'SELECT * FROM proyectos WHERE estado = ''activo'' AND recursos > 500;', 'Obtener todos los proyectos activos que tengan más de 500 recursos.', 'medio'),
(6, 'UPDATE proyectos SET estado = ''cancelado'' WHERE tipo = ''agua'' AND recursos < 100;', 'Cancelar proyectos relacionados con agua que tengan menos de 100 recursos.', 'difícil'),

-- Capítulo 7: La Torre de las Mareas
(7, 'UPDATE valvulas_activas SET tiempo_restante = 1 WHERE sector_id = (SELECT id FROM sectores WHERE nombre = ''barrios pobres'');', 'Reconfigurar válvulas activas para que suministren agua a los pobres en 1 minuto.', 'fácil'),
(7, 'SELECT * FROM valvulas_activas WHERE tiempo_restante > 0 AND sector_id = (SELECT id FROM sectores WHERE nombre = ''pobres'');', 'Consultar válvulas activas con tiempo restante en sectores pobres.', 'medio'),
(7, 'DELETE FROM valvulas_activas WHERE tiempo_restante = 0 AND sector_id = (SELECT id FROM sectores WHERE nombre = ''ricos'');', 'Eliminar válvulas activas sin tiempo restante en sectores ricos.', 'difícil'),

-- Capítulo 8: El Traidor
(8, 'SELECT * FROM transacciones WHERE beneficiario = ''líder trabajador'';', 'Consultar todas las transacciones relacionadas con el líder trabajador.', 'fácil'),
(8, 'SELECT SUM(cantidad) AS total_corrupcion FROM transacciones WHERE tipo = ''soborno'';', 'Calcular el total de recursos asociados a sobornos.', 'medio'),
(8, 'UPDATE transacciones SET estado = ''investigado'' WHERE beneficiario = ''líder trabajador'';', 'Actualizar el estado de transacciones del líder trabajador a investigado.', 'difícil'),

-- Capítulo 9: Desviando el Flujo
(9, 'UPDATE rutas SET destino_id = (SELECT id FROM sectores WHERE nombre = ''barrios pobres'') WHERE destino_id = (SELECT id FROM sectores WHERE nombre = ''fortaleza'');', 'Redirigir las rutas de agua desde la fortaleza hacia los barrios pobres.', 'fácil'),
(9, 'SELECT * FROM rutas WHERE origen_id = (SELECT id FROM sectores WHERE nombre = ''reservorio principal'') AND destino_id = (SELECT id FROM sectores WHERE nombre = ''barrios pobres'');', 'Consultar las rutas que van desde el reservorio principal hacia los barrios pobres.', 'medio'),
(9, 'INSERT INTO rutas (origen_id, destino_id, estado) VALUES ((SELECT id FROM sectores WHERE nombre = ''fuente secundaria''), (SELECT id FROM sectores WHERE nombre = ''barrios pobres''), ''activa'');', 'Insertar una nueva ruta activa desde la fuente secundaria hacia los barrios pobres.', 'difícil'),

-- Capítulo 10: El Ejército del Emperador
(10, 'UPDATE automatizacion SET estado = ''inactivo'' WHERE tipo = ''autómatas'';', 'Desactivar todos los autómatas en el sistema de automatización.', 'fácil'),
(10, 'SELECT COUNT(*) AS total_activos FROM automatizacion WHERE estado = ''activo'' AND tipo = ''autómatas'';', 'Contar el número total de autómatas activos.', 'medio'),
(10, 'DELETE FROM automatizacion WHERE tipo = ''autómatas'' AND estado = ''inactivo'';', 'Eliminar todos los registros de autómatas que estén inactivos.', 'difícil'),

-- Capítulo 11: La Verdad Oculta
(11, 'SELECT SUM(cantidad) AS total FROM reservas WHERE acceso = ''restringido'';', 'Calcular el total de agua en reservas restringidas.', 'fácil'),
(11, 'SELECT * FROM reservas WHERE cantidad > 1000 AND acceso = ''libre'';', 'Consultar reservas con más de 1000 de agua y acceso libre.', 'medio'),
(11, 'UPDATE reservas SET acceso = ''libre'' WHERE cantidad > 500 AND sector = ''pobres'';', 'Liberar acceso a reservas con más de 500 unidades de agua en sectores pobres.', 'difícil'),

-- Capítulo 12: El Enfrentamiento Final
(12, 'UPDATE valvulas SET estado = ''abierta'';', 'Abrir todas las válvulas para que liberen agua.', 'fácil'),
(12, 'SELECT COUNT(*) AS valvulas_abiertas FROM valvulas WHERE estado = ''abierta'';', 'Contar el total de válvulas abiertas.', 'medio'),
(12, 'INSERT INTO historico_valvulas (fecha, estado) VALUES (CURDATE(), ''abiertas'');', 'Registrar en el historial que las válvulas se abrieron en la fecha actual.', 'difícil');



INSERT INTO consultas_erroneas (id_capitulo, consulta_sql, error_descripcion, dificultad) VALUES
-- Capítulo 1: Sed de Venganza
(1, 'SELEC * FROM mapas;', 'Error de sintaxis: falta la palabra completa SELECT', 'Facil'),
(1, 'SELECT * FORM mapas WHERE fortaleza = ''Torre de las Mareas'';', 'Error de sintaxis: FORM en lugar de FROM', 'Facil'),
(1, 'SELECT nombre descripcion FROM mapas;', 'Error de sintaxis: falta la coma entre columnas', 'Facil'),
(1, 'SELECT * FROM mapas WHERE forteleza = ''Torre de las Mareas'';', 'Error de columna: "forteleza" no existe, debe ser "fortaleza"', 'Facil'),

(1, 'SELECT nombre, descripcion FORM mapas WHERE fortaleza = ''Torre de las Mareas'';', 'Error de sintaxis: FORM en lugar de FROM', 'Medio'),
(1, 'SELECT COUNT(seccion FROM mapas WHERE fortaleza = ''Torre de las Mareas'';', 'Error de paréntesis: falta cierre en COUNT', 'Medio'),
(1, 'SELECT * FROM mapas WHERE torre = ''Torre de las Mareas'';', 'Error de columna: "torre" no existe, debe ser "fortaleza"', 'Medio'),
(1, 'SELECT * FROM mapas WHERE fortaleza == ''Torre de las Mareas'';', 'Error de operador: uso incorrecto de "==" en lugar de "="', 'Medio'),

(1, 'SELECT nombre, descripcion FROM mapas WHERE fortaleza LIKE Torre;', 'Error de sintaxis: falta comillas en valor de LIKE', 'Dificil'),
(1, 'SELECT DISTINCT nombre descripcion FROM mapas WHERE fortaleza = ''Torre de las Mareas'';', 'Error de sintaxis: falta coma entre columnas', 'Dificil'),
(1, 'SELECT nombre, descripcion FROM mapas WHERE descripcion = ''%entrada secreta'';', 'Error de operador: falta el LIKE para el patrón', 'Dificil'),
(1, 'SELECT * FROM mapas WHERE fortaleza IN ''Torre de las Mareas'';', 'Error de sintaxis: falta paréntesis en IN', 'Dificil'),

-- Capítulo 2: Cruzando la Frontera
(2, 'SELECT nombre clase FROM identidades;', 'Error de sintaxis: falta la coma entre columnas', 'Facil'),
(2, 'SELECT * FORM identidades;', 'Error de sintaxis: FORM en lugar de FROM', 'Facil'),
(2, 'SELECT nombre FROM identidad;', 'Error de tabla: "identidad" no existe, debe ser "identidades"', 'Facil'),
(2, 'SELECT nombre, clase FROM identidades WHER status = ''activo'';', 'Error de sintaxis: falta la "E" en WHERE', 'Facil'),

(2, 'UPDATE identidades SET estatus = ''activo'' WHERE nombre = ''Ezekiel'';', 'Error de columna: "estatus" no existe, debe ser "status"', 'Medio'),
(2, 'UPDATE identidades SET status = activo WHERE nombre = ''Ezekiel'';', 'Error de sintaxis: falta comillas en valor "activo"', 'Medio'),
(2, 'UPDATE identidades SET status = ''activo'' WHERE nombre = Ezekiel;', 'Error de sintaxis: falta comillas en valor "Ezekiel"', 'Medio'),
(2, 'UPDATE identidad SET status = ''activo'' WHERE nombre = ''Ezekiel'';', 'Error de tabla: "identidad" no existe, debe ser "identidades"', 'Medio'),

(2, 'SELECT nombre, clase FORM identidades WHERE status = ''activo'';', 'Error de sintaxis: FORM en lugar de FROM', 'Dificil'),
(2, 'UPDATE identidades SET status = ''active'' WHERE nombre = ''Ezekiel'';', 'Error de valor: "active" no válido, debe ser "activo"', 'Dificil'),
(2, 'DELETE * FROM identidades WHERE nombre = ''Ezekiel'';', 'Error de sintaxis: DELETE no requiere "*"', 'Dificil'),
(2, 'SELECT COUNT() FROM identidades WHERE clase == ''noble'';', 'Error de operador: uso incorrecto de "==" en lugar de "="', 'Dificil'),

-- Capítulo 3: Válvulas y Secretos
(3, 'SELECT sector tiempo_apertura FROM valvulas;', 'Error de sintaxis: falta la coma entre columnas', 'Facil'),
(3, 'SELECT * FROM valvula;', 'Error de tabla: "valvula" no existe, debe ser "valvulas"', 'Facil'),
(3, 'SELECT ALL FROM valvulas;', 'Error de sintaxis: "ALL" no válido', 'Facil'),
(3, 'SELECT * FROM valvulas WHER fecha = ''2024-11-25'';', 'Error de sintaxis: falta la "E" en WHERE', 'Facil'),

(3, 'SELECT sector, tiempo_apertura FROM valvulas WHERE fecha == ''2024-11-25'';', 'Error de operador: uso incorrecto de "==" en lugar de "="', 'Medio'),
(3, 'SELECT COUNT(sector tiempo_apertura FROM valvulas;', 'Error de sintaxis: falta coma y cierre de paréntesis', 'Medio'),
(3, 'SELECT sector, tiempo_apertura FROM valvulas WHERE tiempo_apertura BETWEEN ''08:00'' AND 12:00;', 'Error de formato: falta comillas en tiempo', 'Medio'),
(3, 'SELECT sector FROM valvulas WHERE fecha = ''25-11-2024'';', 'Error de formato: fecha mal escrita como DD-MM-YYYY', 'Medio'),

(3, 'SELECT DISTINCT sector tiempo_apertura FROM valvulas;', 'Error de sintaxis: falta coma entre columnas', 'Dificil'),
(3, 'SELECT sector, COUNT(*) AS total FROM valvulas WHERE estado = ''abierto'' GROUP BY sector;', 'Error de valor: "abierto" no válido, debe ser "abierta"', 'Dificil'),
(3, 'SELECT sector, tiempo_apertura FROM valvulas WHERE tiempo_apertura > 08:00;', 'Error de formato: falta comillas en tiempo', 'Dificil'),
(3, 'SELECT * FROM valvulas WHERE sector IN (''norte'', sur);', 'Error de sintaxis: falta comillas en valor "sur"', 'Dificil'),

-- Capítulo 4: Aliados en la Oscuridad
(4, 'SELECT cantidad sector FROM suministros WHERE sector = ''trabajadores'';', 'Error de sintaxis: falta la coma entre columnas', 'Facil'),
(4, 'SELECT * FROM suministro WHERE sector = ''trabajadores'';', 'Error de tabla: "suministro" no existe, debe ser "suministros"', 'Facil'),
(4, 'SELECT * FROM suministros WHERE sector == ''trabajadores'';', 'Error de operador: uso incorrecto de "==" en lugar de "="', 'Facil'),
(4, 'SELECT * FROM suministros WHERE sectore = ''trabajadores'';', 'Error de columna: "sectore" no existe, debe ser "sector"', 'Facil'),

(4, 'SELECT fecha FROM suministros WHERE cantidad > 0 ORDER ASC;', 'Error de sintaxis: falta la palabra clave "BY" en ORDER BY', 'Medio'),
(4, 'SELECT fecha, cantidad FROM suministros WHERE sector = trabajadores;', 'Error de formato: falta comillas en valor "trabajadores"', 'Medio'),
(4, 'UPDATE suministros SET cantidad = cantidad - 10 WHERE sector = ''trabajadores'';', 'Error de lógica: intenta modificar datos en una consulta de lectura', 'Medio'),
(4, 'SELECT fecha FROM suministros WHERE sector = ''trabajadores'' AND cantidad > 0 GROUP BY fecha;', 'Error lógico: GROUP BY innecesario en este contexto', 'Medio'),

(4, 'SELECT sector, SUM(cantidad) AS total GROUP BY sector;', 'Error de sintaxis: falta FROM en la consulta', 'Dificil'),
(4, 'SELECT sector, SUM(cantidad) AS total FROM suministros HAVING total > 100;', 'Error lógico: falta GROUP BY antes de HAVING', 'Dificil'),
(4, 'SELECT sector, cantidad SUM(cantidad) FROM suministros GROUP BY sector;', 'Error de sintaxis: falta coma antes de SUM()', 'Dificil'),
(4, 'SELECT sector, SUM(cantidad) AS total FROM suministros WHERE total > 100;', 'Error lógico: "total" no es válido en WHERE, debe usarse HAVING', 'Dificil'),

-- Capítulo 5: La Sala de Control Exterior
(5, 'SELECT * FROM registros WHERE fecha < 2023-01-01;', 'Error de formato: falta comillas en la fecha', 'Facil'),
(5, 'SELECT COUNT(fecha) WHERE fecha < ''2023-01-01'';', 'Error de sintaxis: falta FROM en la consulta', 'Facil'),
(5, 'SELECT * FORM registros WHERE fecha < ''2023-01-01'';', 'Error de sintaxis: FORM en lugar de FROM', 'Facil'),
(5, 'SELECT nombre FROM registros WHERE fecha = ''2023-10-01'';', 'Error de fecha: mal formato de la fecha', 'Facil'),

(5, 'SELECT COUNT(*) AS total WHERE fecha < ''2023-01-01'';', 'Error de sintaxis: falta FROM en la consulta', 'Medio'),
(5, 'SELECT nombre FROM registros WHERE fecha BETWEEN ''2023-01-01'' AND ''2023-01-31'';', 'Error de formato: fecha mal escrita como DD-MM-YYYY', 'Medio'),
(5, 'SELECT * FROM registros WHERE fecha < ''2023-01-01'' AND status = ''activo'' GROUP BY fecha;', 'Error lógico: GROUP BY innecesario en este contexto', 'Medio'),
(5, 'SELECT nombre, COUNT(*) AS total FROM registros WHERE fecha = ''2023-01-01'' GROUP BY nombre;', 'Error lógico: COUNT no debe agrupar por "nombre"', 'Medio'),

(5, 'SELECT nombre, COUNT(*) AS total FROM registros GROUP BY nombre HAVING total > 10;', 'Error lógico: "total" no válido en HAVING', 'Dificil'),
(5, 'SELECT * FROM registros WHERE fecha = ''2023-01-01'' GROUP BY fecha;', 'Error lógico: GROUP BY innecesario en este contexto', 'Dificil'),
(5, 'SELECT COUNT(*) AS total FROM registros WHERE fecha IN (''2023-01-01'', ''2023-01-02'') AND status = ''activo'';', 'Error de sintaxis: "IN" no debe usarse con fecha como en formato string', 'Dificil'),
(5, 'SELECT nombre FROM registros WHERE fecha = ''2023-01-01'' ORDER BY nombre;', 'Error de sintaxis: falta GROUP BY en la consulta', 'Dificil'),

-- Capítulo 6: La Conspiración de los Ricos
(6, 'SELECT tipo energia FROM generadores;', 'Error de sintaxis: falta coma entre columnas', 'Facil'),
(6, 'SELECT * FORM generadores;', 'Error de sintaxis: FORM en lugar de FROM', 'Facil'),
(6, 'SELECT tipo FROM generador;', 'Error de tabla: "generador" no existe, debe ser "generadores"', 'Facil'),
(6, 'SELECT nombre, tipo FROM generadores WHER energia = ''solar'';', 'Error de sintaxis: falta la "E" en WHERE', 'Facil'),

(6, 'SELECT COUNT(energia) FROM generadores WHERE tipo = ''solar'';', 'Error lógico: no se debe usar COUNT con una sola columna sin GROUP BY', 'Medio'),
(6, 'SELECT tipo, COUNT(*) AS total FROM generadores WHERE energia = ''solar'' GROUP BY tipo;', 'Error lógico: "total" no válido en WHERE', 'Medio'),
(6, 'UPDATE generadores SET energia = ''eolica'' WHERE tipo = ''solar'';', 'Error de columna: "energia" no existe, debe ser "tipo"', 'Medio'),
(6, 'SELECT * FROM generadores WHERE tipo LIKE ''solar%'';', 'Error de sintaxis: falta comillas en LIKE', 'Medio'),

(6, 'SELECT tipo, COUNT(*) AS total FROM generadores GROUP BY tipo HAVING total > 100;', 'Error de lógica: "total" no válido en HAVING', 'Dificil'),
(6, 'SELECT nombre FROM generadores WHERE energia = ''solar'' AND tipo = ''renovable'';', 'Error de sintaxis: "AND" innecesario', 'Dificil'),
(6, 'SELECT tipo, energia FROM generadores WHERE energia IN (''solar'', ''eolica'') GROUP BY tipo;', 'Error lógico: GROUP BY innecesario', 'Dificil'),
(6, 'SELECT tipo, energia FROM generadores ORDER BY energia LIMIT 10;', 'Error de sintaxis: LIMIT no debe usarse después de ORDER BY', 'Dificil'),

-- Capítulo 7: La Torre de las Mareas
(7, 'SELECT nombre, habilidad FROM exploradores;', 'Error de sintaxis: falta coma entre columnas', 'Facil'),
(7, 'SELECT * FROM exploradors;', 'Error de tabla: "exploradors" no existe, debe ser "exploradores"', 'Facil'),
(7, 'SELECT habilidad FROM exploradores WHERE nivel = 3;', 'Error de columna: "nivel" no existe, debe ser "dificultad"', 'Facil'),
(7, 'SELECT * FORM exploradores;', 'Error de sintaxis: FORM en lugar de FROM', 'Facil'),

(7, 'SELECT nombre, habilidad FROM exploradores WHERE nivel = 5;', 'Error de columna: "nivel" no existe, debe ser "dificultad"', 'Medio'),
(7, 'UPDATE exploradores SET habilidad = ''agilidad'' WHERE nombre = ''Ezekiel'';', 'Error de columna: "habilidad" no existe, debe ser "habilidades"', 'Medio'),
(7, 'DELETE FROM exploradores WHERE nombre = ''Ezekiel'' AND habilidad = ''agilidad'';', 'Error lógico: DELETE no necesita la cláusula AND', 'Medio'),
(7, 'SELECT nombre FROM exploradores WHERE dificultad == 3;', 'Error de operador: uso incorrecto de "==" en lugar de "="', 'Medio'),

(7, 'SELECT COUNT(*) AS total FROM exploradores WHERE habilidad LIKE ''%esquivar%'';', 'Error de sintaxis: falta comillas en LIKE', 'Dificil'),
(7, 'SELECT nombre, habilidad FROM exploradores WHERE dificultad > 3;', 'Error lógico: "dificultad" mal usado en lugar de "nivel"', 'Dificil'),
(7, 'SELECT DISTINCT nombre FROM exploradores;', 'Error de sintaxis: DISTINCT no se usa sin columnas adicionales', 'Dificil'),
(7, 'SELECT nombre, habilidad FROM exploradores WHERE dificultad BETWEEN 3 AND 5;', 'Error de sintaxis: columna "dificultad" no existe, debe ser "nivel"', 'Dificil'),

-- Capítulo 8: El Traidor
(8, 'SELECT * FROM codigos WHERE mensaje = ''secreto'';', 'Error de sintaxis: falta comillas en valor "secreto"', 'Facil'),
(8, 'SELECT codigo FROM codigos WHERE mensaje LIKE %misterio%;', 'Error de sintaxis: falta comillas en LIKE', 'Facil'),
(8, 'SELECT * FORM codigos;', 'Error de sintaxis: FORM en lugar de FROM', 'Facil'),
(8, 'SELECT * FROM codigos WHERE mensaje = secreto;', 'Error de sintaxis: falta comillas en valor "secreto"', 'Facil'),

(8, 'SELECT COUNT(*) FROM codigos WHERE mensaje = ''secreto'';', 'Error lógico: COUNT no es necesario sin un GROUP BY', 'Medio'),
(8, 'UPDATE codigos SET mensaje = ''resuelto'' WHERE codigo = 5;', 'Error de valor: código 5 no existe', 'Medio'),
(8, 'SELECT mensaje FROM codigos WHERE codigo BETWEEN 1 AND 5;', 'Error de lógica: entre valores 1 y 5 no se encuentran los códigos válidos', 'Medio'),
(8, 'DELETE FROM codigos WHERE mensaje = ''secreto'';', 'Error lógico: DELETE no necesita la cláusula WHERE', 'Medio'),

(8, 'SELECT mensaje, COUNT(*) FROM codigos GROUP BY mensaje HAVING COUNT(*) > 1;', 'Error lógico: COUNT no debe agrupar por mensaje', 'Dificil'),
(8, 'SELECT mensaje FROM codigos WHERE mensaje IN (''secreto'', ''resuelto'');', 'Error de sintaxis: IN no debe usarse con comillas en valores de mensaje', 'Dificil'),
(8, 'SELECT * FROM codigos WHERE codigo LIKE 1%', 'Error de sintaxis: falta comillas en LIKE', 'Dificil'),
(8, 'SELECT * FROM codigos WHERE mensaje = ''misterio'';', 'Error de sintaxis: mensaje debe ser "secreto" o valores válidos', 'Dificil'),

-- Capítulo 9: Desviando el Flujo
(9, 'SELECT nombre, corazon FROM almas;', 'Error de sintaxis: falta coma entre columnas', 'Facil'),
(9, 'SELECT * FORM almas;', 'Error de sintaxis: FORM en lugar de FROM', 'Facil'),
(9, 'SELECT * FROM almas WHERE corazon = ''puro'';', 'Error de columna: "corazon" no existe, debe ser "alma"', 'Facil'),
(9, 'SELECT * FROM almas WHERE corazon = ''roto'';', 'Error de columna: "roto" no es un valor válido para corazon', 'Facil'),

(9, 'SELECT nombre FROM almas WHERE corazon = ''roto'';', 'Error lógico: "roto" no es un valor válido', 'Medio'),
(9, 'UPDATE almas SET corazon = ''renovado'' WHERE nombre = ''Ezekiel'';', 'Error de columna: "renovado" no existe en la base de datos', 'Medio'),
(9, 'DELETE FROM almas WHERE corazon = ''puro'';', 'Error lógico: DELETE no es necesario sin un filtro', 'Medio'),
(9, 'SELECT * FROM almas WHERE corazon == ''puro'';', 'Error de operador: uso incorrecto de "==" en lugar de "="', 'Medio'),

(9, 'SELECT nombre, corazon FROM almas GROUP BY corazon;', 'Error de sintaxis: GROUP BY necesita más columnas', 'Dificil'),
(9, 'SELECT nombre FROM almas WHERE corazon = ''puro'' AND alma = ''espiritu'';', 'Error de sintaxis: "alma" mal usado', 'Dificil'),
(9, 'SELECT nombre FROM almas WHERE corazon LIKE ''%puro%'';', 'Error de sintaxis: falta comillas en LIKE', 'Dificil'),
(9, 'SELECT COUNT(*) AS total FROM almas WHERE corazon = ''roto'';', 'Error de valor: "roto" no válido', 'Dificil'),

-- Capítulo 10: El Ejército del Emperador
(10, 'SELECT * FROM fuerzas WHERE tipo = ''vacío'';', 'Error de sintaxis: falta comillas en tipo', 'Facil'),
(10, 'SELECT tipo FROM fuerzas WHERE nivel = 5;', 'Error de columna: "nivel" no existe, debe ser "intensidad"', 'Facil'),
(10, 'SELECT * FORM fuerzas;', 'Error de sintaxis: FORM en lugar de FROM', 'Facil'),
(10, 'SELECT nombre FROM fuerzas WHERE tipo = ''vacío'' AND nivel = 5;', 'Error de columna: "nivel" no existe, debe ser "intensidad"', 'Facil'),

(10, 'SELECT tipo, nivel FROM fuerzas WHERE intensidad = 10;', 'Error de columna: "nivel" no existe, debe ser "intensidad"', 'Medio'),
(10, 'UPDATE fuerzas SET tipo = ''hielo'' WHERE nombre = ''Ezekiel'';', 'Error de columna: "hielo" no existe en las fuerzas', 'Medio'),
(10, 'SELECT * FROM fuerzas WHERE nivel BETWEEN 1 AND 5;', 'Error lógico: "nivel" no debe usarse sin GROUP BY', 'Medio'),
(10, 'DELETE FROM fuerzas WHERE tipo = ''vacío'' AND nivel > 5;', 'Error lógico: DELETE no necesita filtro con nivel', 'Medio'),

(10, 'SELECT tipo, COUNT(*) FROM fuerzas GROUP BY tipo;', 'Error de sintaxis: falta la columna después de COUNT', 'Dificil'),
(10, 'SELECT nombre, tipo FROM fuerzas WHERE tipo = ''vacío'' ORDER BY nombre;', 'Error lógico: ORDER BY no debe usarse sin GROUP BY', 'Dificil'),
(10, 'SELECT tipo FROM fuerzas WHERE intensidad = 10 AND nivel = 5;', 'Error lógico: uso incorrecto de "AND" con nivel', 'Dificil'),
(10, 'SELECT * FROM fuerzas WHERE tipo IN (''vacío'', ''hielo'') GROUP BY tipo;', 'Error lógico: GROUP BY innecesario en este contexto', 'Dificil'),

-- Capítulo 11: La Verdad Oculta
(11, 'SELECT nombre, rango FROM guardianes;', 'Error de sintaxis: falta coma entre columnas', 'Facil'),
(11, 'SELECT * FROM guardianes WHERE rango = ''alto'';', 'Error de columna: "rango" no existe, debe ser "nivel"', 'Facil'),
(11, 'SELECT * FORM guardianes;', 'Error de sintaxis: FORM en lugar de FROM', 'Facil'),
(11, 'SELECT nombre, rango FROM guardianes WHERE nivel = 10;', 'Error de columna: "nivel" no existe, debe ser "rango"', 'Facil'),

(11, 'SELECT COUNT(*) FROM guardianes WHERE nivel = 10;', 'Error de lógica: COUNT no se usa sin GROUP BY', 'Medio'),
(11, 'UPDATE guardianes SET rango = ''élite'' WHERE nombre = ''Ezekiel'';', 'Error de valor: "élite" no existe', 'Medio'),
(11, 'SELECT * FROM guardianes WHERE rango = ''alto'' AND nivel = 10;', 'Error de columna: "nivel" no existe', 'Medio'),
(11, 'DELETE FROM guardianes WHERE rango = ''alto'';', 'Error lógico: DELETE no es necesario sin la cláusula WHERE', 'Medio'),

(11, 'SELECT nombre, COUNT(*) FROM guardianes GROUP BY rango;', 'Error de sintaxis: "COUNT" no requiere agrupación en este caso', 'Dificil'),
(11, 'SELECT nombre FROM guardianes WHERE nivel = 10 AND rango = ''élite'';', 'Error de columna: "nivel" no existe', 'Dificil'),
(11, 'SELECT * FROM guardianes WHERE nivel = 10 ORDER BY nombre;', 'Error lógico: ORDER BY no es necesario sin un filtro', 'Dificil'),
(11, 'SELECT nombre FROM guardianes WHERE rango = ''alto'';', 'Error de sintaxis: falta columna en la cláusula SELECT', 'Dificil'),

-- Capítulo 12: El Enfrentamiento Final
(12, 'SELECT nombre, habilidad FROM encuentro;', 'Error de tabla: "encuentro" no existe', 'Facil'),
(12, 'SELECT * FORM encuentro;', 'Error de sintaxis: FORM en lugar de FROM', 'Facil'),
(12, 'SELECT * FROM encuentro WHERE tipo = ''final'';', 'Error de columna: "tipo" no existe', 'Facil'),
(12, 'SELECT nombre FROM encuentro WHERE habilidad = ''estrategia'';', 'Error lógico: columna "habilidad" no existe', 'Facil'),

(12, 'SELECT * FROM encuentro WHERE nivel = 10;', 'Error de columna: "nivel" no existe', 'Medio'),
(12, 'UPDATE encuentro SET tipo = ''despedida'' WHERE nombre = ''Ezekiel'';', 'Error de valor: "despedida" no existe', 'Medio'),
(12, 'SELECT * FROM encuentro WHERE tipo LIKE ''final%'';', 'Error de sintaxis: falta comillas en LIKE', 'Medio'),
(12, 'SELECT nombre FROM encuentro WHERE habilidad = ''estrategia'' AND tipo = ''final'';', 'Error lógico: tipo no debe usarse sin la cláusula GROUP BY', 'Medio'),

(12, 'SELECT nombre FROM encuentro WHERE habilidad = ''estrategia'' ORDER BY nivel;', 'Error lógico: ORDER BY innecesario', 'Dificil'),
(12, 'SELECT tipo, COUNT(*) FROM encuentro GROUP BY habilidad;', 'Error de sintaxis: "COUNT" no debe usarse sin un filtro adecuado', 'Dificil'),
(12, 'SELECT nombre FROM encuentro WHERE tipo = ''final'';', 'Error de sintaxis: falta columna en SELECT', 'Dificil'),
(12, 'SELECT * FROM encuentro WHERE habilidad = ''estrategia'';', 'Error de columna: "habilidad" no existe', 'Dificil');




