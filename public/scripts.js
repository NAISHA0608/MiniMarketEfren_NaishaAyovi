// scripts.js
document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("miFormulario");

    formulario.addEventListener("submit", function(event) {
        if (!validarFormulario()) {
            event.preventDefault(); // Previene el envío del formulario si la validación falla
        }
    });
});

function validarFormulario() {
    const nombre = document.getElementById("name").value;
    const precio = document.getElementById("precio").value;
    const cantidad = document.getElementById("cantidad").value;
    const nombreRegex = /^[A-Za-z\s]+$/;
    const precioRegex = /^[0-9]+$/;

    // Validar el nombre del electrodoméstico
    if (!nombreRegex.test(nombre)) {
        alert("El nombre del electrodoméstico debe contener solo letras y espacios.");
        return false;
    }

    // Validar el precio del producto
    if (!precioRegex.test(precio) || parseFloat(precio) <= 0) {
        alert("El precio del producto debe ser un número positivo.");
        return false;
    }

    // Validar la cantidad del producto
    if (!precioRegex.test(cantidad) || parseInt(cantidad) <= 0) {
        alert("La cantidad del producto debe ser un número positivo.");
        return false;
    }

    return true;
}
