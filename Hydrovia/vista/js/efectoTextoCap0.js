// Texto del párrafo que quieres mostrar
const texto = `Hydrovia, es una sociedad dividida, por un lado están los ricos, que tienen acceso ilimitado al agua, y los pobres, que luchan por sobrevivir. El agua es controlada por gigantescas válvulas administradas por el tiránico Emperador de Bronce, quien las abre solo unos minutos al día, liberando solo lo suficiente para que los pobres no mueran de sed. 

Tú como jugador tomas el rol de Ezekiel, un joven de los barrios bajos que, tras la muerte de su hermana por deshidratación, decide infiltrarse en la fortaleza de los ricos. Al descubrir que el sistema de válvulas está gestionado por una base de datos, Ezekiel intenta hackearla para liberar el agua para todo el pueblo.`;

// Selecciona el párrafo donde se mostrará el texto
const parrafo = document.getElementById("parrafo_capitulo0");

// Variables para el efecto de escritura
let indice = 0;

// Función que escribe el texto letra por letra
function escribirTexto() {
    if (indice < texto.length) {
        parrafo.innerHTML += texto.charAt(indice); // Añade la letra al contenido del párrafo
        indice++;
        setTimeout(escribirTexto, 35); // Ajusta el tiempo entre letras (en milisegundos)
    }
}

// Inicia el efecto de escritura al cargar la página
document.addEventListener("DOMContentLoaded", escribirTexto);
