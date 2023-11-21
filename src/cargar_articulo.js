/////////////////Abrir Modal//////////////
// Espera a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    // Obtener elementos DOM
    const abrirModalBtn = document.getElementById("abrirModal");
    const cerrarModalBtn = document.getElementById("cerrarModal");
    const miModal = document.getElementById("miModal");

    // Abrir el modal al hacer clic en el botón
    abrirModalBtn.addEventListener("click", () => {
        miModal.classList.remove("invisible");
    });

    // Cerrar el modal al hacer clic en el botón de cerrar
    cerrarModalBtn.addEventListener("click", () => {
        miModal.classList.add("invisible");
    });

    // Cerrar el modal haciendo clic fuera del modal
    window.addEventListener("click", (event) => {
        if (event.target === miModal) {
            miModal.classList.add("invisible");
        }
    });
});
