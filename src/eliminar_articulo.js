
////////////////////////confirmar eliminacion/////////////

// Función para confirmar la eliminación
function confirmarEliminacion() {
    const id = this.getAttribute("data-id");
    const nombre_del_producto = this.getAttribute("data-nombre");

    if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        window.location.href =
            "delete.php?id=" +
            id +
            "&confirm=1&nombre_del_producto=" +
            encodeURIComponent(nombre_del_producto);
    }
}

// Espera a que se cargue el contenido de la página antes de agregar manejadores de clic
document.addEventListener("DOMContentLoaded", () => {
    // Obtener todos los botones de eliminar
    const eliminarBotones = document.querySelectorAll('[id^="eliminarBtn-"]');

    // Agregar un manejador de clic a cada botón de eliminar
    eliminarBotones.forEach((boton) => {
        boton.addEventListener("click", confirmarEliminacion);
    });
});
