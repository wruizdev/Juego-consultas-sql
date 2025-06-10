
//función mostrar modal
function mostrarModal() {
    document.getElementById("miModal").style.display = "block";

    //añadir la clase para quitar la barra de desplazamineto vertical (scroll)
    document.body.classList.add("modal-abierto");
}

//función cerrar modal (cruz)
function cerrarModal() {
    document.getElementById("miModal").style.display = "none";

    // quitar clase para habilitar la barra de desplazamineto vertical (scroll)
    document.body.classList.remove("modal-abierto");
}

// con esto se cierra el modal cuando se haga clic fuera de la imagen
window.onclick = function(event) {
    if (event.target == document.getElementById("miModal")) {
        cerrarModal();
    }
}
