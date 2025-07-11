# Hydrovia: Un Viaje Steampunk para Aprender SQL

## **Breve Descripción**

**Hydrovia** es un juego interactivo inspirado en la estética **Steampunk** que permite a los usuarios practicar consultas SQL mientras viven una historia emocionante. A lo largo de 12 capítulos, los jugadores deben resolver desafíos relacionados con la gestión de bases de datos para restaurar el equilibrio en un reino dividido por la falta de recursos. Con cada acierto, avanzan en la historia; pero los errores pueden hacerles perder puntos de vida.


---

## **Instalación**

1. **Cargar base de datos**
   - Localizar el script DB_reto.sql.
   - Arrancar el servidor de base de datos MariaDB o MySQL.
   - Cargar la base de datos y ejecutar.
   - Comprobar que la base de datos bd_reto se ha creado al refrescar todas las bases de datos del usuario que se está utilizando.

2. **Modificar archivo de conexión PDO**
   - Localizar el fichero conexionPDO.php dentro del directorio modelo del proyecto.
   - Modificar las variables de conexión: $host (incluir el nombre del servidor: localhost o la dirección IP del servidor que almacena la base de datos), $database (incluir del nombre de la base de datos: db_reto),
   $user (incluir el nombre del usuario que se utiliza para acceder a la base de datos: root, super, etc), $password (incluir la contraseña del usuario que se está utilizando o dejar vacía según la configuración del usuario).
   - Una vez modificadas las variables, guardar los cambios.

3. **Acceso desde el navegador**
   - Utilizar un navegador Chrome y en barra de direcciones escribir: si se está ejecutando desde local  `localhost/Hydrovia`; si el proyecto está alojado dentro de un servidor externo
   `direcciónIPServidor/Hydrovia`.
---

## **Cómo Jugar**

1. **Inicio de Sesión**  
   - Al acceder al juego, encontrarás un formulario de inicio de sesión.  
   - Si no tienes cuenta, puedes registrarte desde la opción **"Registro"**.

2. **Opciones al Iniciar Sesión**  
   - **Jugar Nueva Partida**: Comienza desde el capítulo 0, la introducción.  
   - **Continuar Partida**: Retoma tu progreso anterior gracias al sistema de guardado de sesiones.  

3. **Selección de Dificultad**  
   - Elige entre **Fácil**, **Medio** y **Difícil**.  
   - La dificultad afecta la complejidad de las consultas SQL y la cantidad de puntos de vida perdidos por error:  
     - Fácil: Pierdes **10 puntos**.  
     - Medio: Pierdes **20 puntos**.  
     - Difícil: Pierdes **30 puntos**.  
   - Todos los jugadores comienzan con **100 puntos de vida**.

4. **Progresión del Juego**  
   - El juego consta de **12 capítulos** y un capítulo 0 introductorio.  
   - En cada capítulo, recibirás una breve descripción de la historia relacionada con ese capítulo y el objetivo de la consulta.
   -Se te presentarán tres posibles consultas SQL como opciones (radios).
   -Solo una consulta es correcta. Si seleccionas y aceptas la consulta correcta, avanzas al siguiente capítulo.  
   - Si necesitas ayuda al responder, puedes consultar la base de datos que aparece el botón "Consultar Base de Datos".  

5. **Final del Juego**  
   - Si completas el capítulo 12 con puntos de vida restantes, habrás cumplido el objetivo: **Restaurar el sistema y salvar a la población**.  
   - Si pierdes todos los puntos, deberás empezar nuevamente desde el capítulo 1.

---

## **Historia**

Hydrovia es un reino sumido en la desigualdad: los ricos disfrutan de abundancia, mientras que los pobres luchan por conseguir lo más básico, como el acceso al agua potable. Esta disparidad se debe a un sistema de distribución de recursos completamente corrupto, gestionado por un complejo sistema de válvulas y datos que los líderes de Hydrovia controlan para mantener el poder.

Tú eres **Ezekiel**, un ingeniero brillante que, cansado de la injusticia, decide tomar el control de la situación. Armado con tu conocimiento de sistemas de datos y tecnología, te adentras en el corazón del sistema para manipular las válvulas y redistribuir el agua entre las distintas áreas del reino.


---

## **Tecnologías Usadas**

- **Backend**: PHP  
- **Frontend**: HTML5, CSS3, JavaScript.  
- **Base de Datos**: MySQL  

---

## **Estructura de Carpetas**

RETO DWES RA4-5-6/
│
├── index.php                    # Página principal y pantalla de login
│
├── /controlador                 # Lógica de controladores del juego
│   ├── controladorDeGuardadoSesion.php
│   ├── constructorDeCapitulo.php
│   ├── controladorRegistro.php
│   ├── FuncionesDatosJson.php
│   └── ingresar.php
│
├── /modelo                      # Conexión a la base de datos y funciones relacionadas
│   └── conexionPDO.php
│
├── /vista                       # Archivos para la interfaz de usuario
│   ├── capitulo.php             # Vista controlar el capítulo y actualizar la sesión del usuario.
│   ├── capitulo0.php            # Vista para el Capítulo 0 (introducción)
│   ├── derrota.php              # Vista cuando el jugador pierde
│   ├── eleccionNiveles.php      # Vista para seleccionar nivel dificultad
│   ├── formularioRegistro.php   # Formulario para registrar una nueva cuenta
│   ├── inicioJuego.php          # Vista principal al comenzar el juego
│   ├── juegoCompletado.php      # Vista cuando el jugador completa el juego
│   ├── pruebaRestaurarDatos.php # Vista para probar restaurar datos de sesión
│   └── /subcarpeta
│       ├── /css                 # Archivo de estilos CSS
│       │   └── estilos.css
│       ├── /img                 # Imágenes para la interfaz del juego
│       │   ├── fondo.png
│       │   ├── fondo2.png
│       │   ├── icono_salir.png
│       │   └── imagenBD.png
│       │   └── derrota.jpg
│       ├── /imgCapitulos        # Imágenes relativas a cada capítulo
│       │   ├── capitulo01.png
│       │   ├── capitulo02.png
│       │   └── ... (hasta capitulo12.png)
│       └── /fonts               # Fuentes personalizadas
│           ├── HALTimezone.ttf
│           └── Mabry-Pro.ttf
└── README.md               	  # Documentación del proyecto


---


## **Base de Datos**

La base de datos `bd_reto` se utiliza para almacenar la información del juego y consta de las siguientes tablas:

- **usuarios**: Almacena la información de los usuarios registrados, incluyendo nombre, correo, contraseña, progreso (capítulo actual) y puntos de vida.
- **capitulos**: Contiene los detalles de los capítulos del juego, como el título y la descripción de cada uno.
- **sesiones**: Registra información sobre las sesiones activas de los usuarios, permitiendo continuar el juego desde donde lo dejaron.
- **consultas_sql_correctas**: Guarda las consultas SQL correctas para cada capítulo y nivel de dificultad.
- **consultas_erroneas**: Almacena las consultas erróneas y sus respectivas descripciones, que ayudan al jugador a identificar sus errores.


---



## **Créditos**

Este proyecto fue creado por **Michael Alberto, William Ruiz y Carla Lozano** como parte de un reto de aprendizaje en PHP y desarrollo web. 


