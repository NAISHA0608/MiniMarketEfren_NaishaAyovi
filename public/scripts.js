document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("productForm");

    formulario.addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Evita que el formulario se envíe si la validación falla
        }
    });
});

function validateForm() {
    const nombre = document.getElementById("nombre").value.trim();
    const precio = document.getElementById("precio").value.trim();
    const cantidad = document.getElementById("cantidad").value.trim();
    const nombreRegex = /^[a-zA-Z\s]+$/;
    const precioRegex = /^\d+(\.\d{1,2})?$/;
    const cantidadRegex = /^\d+$/;

    let valid = true;

    if (!nombreRegex.test(nombre)) {
        document.getElementById("error-nombre").textContent = "El nombre del producto solo debe contener letras y espacios.";
        valid = false;
    } else {
        document.getElementById("error-nombre").textContent = "";
    }

    if (!precioRegex.test(precio)) {
        document.getElementById("error-precio").textContent = "El precio por unidad debe ser un número válido.";
        valid = false;
    } else {
        document.getElementById("error-precio").textContent = "";
    }

    if (!cantidadRegex.test(cantidad) || parseInt(cantidad) <= 0) {
        document.getElementById("error-cantidad").textContent = "La cantidad en inventario debe ser un número entero positivo.";
        valid = false;
    } else {
        document.getElementById("error-cantidad").textContent = "";
    }

    return valid;
}

