const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const nombre = document.getElementById("nombre");
  const correo = document.getElementById("correo");
  const genero = document.getElementById("genero");
  const contrasena = document.getElementById("contrasena");
  const telefono = document.getElementById("telefono");
  const direccion = document.getElementById("direccion");
  const edad = document.getElementById("edad");

  
  const errorContainer = document.createElement("div");
  errorContainer.classList.add("alert", "alert-danger");
  errorContainer.style.display = "none";
  form.parentNode.insertBefore(errorContainer, form);

  form.addEventListener("submit", (e) => {
    let errores = [];

    if (nombre.value.trim().length < 2) {
      errores.push("El nombre debe tener al menos 2 caracteres.");
    }

    if (!regexCorreo.test(correo.value.trim())) {
      errores.push("El correo no tiene un formato válido.");
    }

    if (!genero.value) {
      errores.push("Debe seleccionar un género.");
    }

    // Validar solo si existe el campo contraseña (modo creación)
    if (contrasena && contrasena.required && contrasena.value.length < 6) {
      errores.push("La contraseña debe tener al menos 6 caracteres.");
    }

    if (!/^\d{10}$/.test(telefono.value)) {
      errores.push("El teléfono debe tener 10 dígitos numéricos.");
    }

    if (direccion.value.trim() === "") {
      errores.push("La dirección no puede estar vacía.");
    }

    const edadVal = parseInt(edad.value);
    if (isNaN(edadVal) || edadVal < 0 || edadVal > 120) {
      errores.push("La edad debe ser un número entre 0 y 120.");
    }

    if (errores.length > 0) {
      e.preventDefault();
      errorContainer.innerHTML = errores.map(err => `<div>${err}</div>`).join('');
      errorContainer.style.display = "block";
      window.scrollTo(0, 0);
    } else {
      errorContainer.style.display = "none";
    }
  });
});
