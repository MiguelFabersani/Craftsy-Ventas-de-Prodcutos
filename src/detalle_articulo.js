

function abrirDetalleModal(id) {
    fetch("detalles_articulo.php?id=" + id) // Asegúrate de que la ruta y el nombre del archivo sean correctos
        .then((response) => response.json())
        .then((datos) => {
            // Asignar los datos del artículo a los elementos del modal
            document.getElementById("imagenProducto").src = "../foto/" + datos.thumb;
            document.getElementById("nombreProducto").innerText =
                datos.nombre_del_producto;
            document.getElementById("precioProducto").innerText = "$" + datos.precio;
            document.getElementById("garantiaProducto").innerText =
                datos.garantia_politica_de_devolucion;
            document.getElementById("descripcionProducto").innerText =
                datos.descripcion_del_producto;
            document.getElementById("fechaProducto").innerText = datos.created_at;

            // Mostrar el modal
            var modal = document.getElementById("detalleModal");
            modal.classList.remove("invisible");

            // Agregar event listener al botón de cierre del modal
            var closeButton = modal.querySelector(".modal-close");
            closeButton.addEventListener("click", cerrarModal);

            // Agregar event listener a la parte oscura del modal
            var modalOverlay = modal.querySelector(".modal-container");
            modalOverlay.addEventListener("click", cerrarModal);
        })
        .catch((error) =>
            console.error("Error al obtener los detalles del artículo:", error)
        );
}

// Función para cerrar el modal
function cerrarModal() {
    var modal = document.getElementById("detalleModal");
    modal.classList.add("invisible");
}
