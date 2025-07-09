const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formDoctor");
  const errorContainer = document.createElement("div");
  errorContainer.classList.add("alert", "alert-danger");
  errorContainer.style.display = "none";
  form.parentNode.insertBefore(errorContainer, form);

  const nombre = document.getElementById("nombre");
  const correo = document.getElementById("correo");
  const contrasena = document.getElementById("contrasena");
  const cedula = document.getElementById("cedula");
  const especialidad = document.getElementById("especialidad");
  const telefono = document.getElementById("telefono");
  const direccion = document.getElementById("direccion");

  form.addEventListener("submit", (e) => {
    let errores = [];

    if (nombre.value.trim().length < 2) {
      errores.push("El nombre debe tener al menos 2 caracteres.");
    }

    if (!regexCorreo.test(correo.value.trim())) {
      errores.push("Correo no válido.");
    }

    if (contrasena && contrasena.required && contrasena.value.length < 6) {
      errores.push("La contraseña debe tener al menos 6 caracteres.");
    }

    if (cedula.value.trim() === "") {
      errores.push("La cédula es obligatoria.");
    }

    if (especialidad.value.trim() === "") {
      errores.push("La especialidad es obligatoria.");
    }

    if (!/^\d{10}$/.test(telefono.value.trim())) {
      errores.push("El teléfono debe tener 10 dígitos numéricos.");
    }

    if (direccion.value.trim() === "") {
      errores.push("La dirección no puede estar vacía.");
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
