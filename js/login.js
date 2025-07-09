document.getElementById("formLogin").addEventListener("submit", function (e) {
  e.preventDefault();

  const correo = document.getElementById("correo").value.trim();
  const contrasena = document.getElementById("contrasena").value;
  const tipoUsuario = document.querySelector('input[name="tipoUsuario"]:checked').value;
  const mensajeError = document.getElementById("mensajeError");

 

  const usuario = usuariosValidos[tipoUsuario];

  if (correo === usuario.correo && contrasena === usuario.contrasena) {
    // Redirigir al menú correspondiente
    window.location.href = usuario.redireccion;
  } else {
    // Mostrar mensaje de error
    mensajeError.textContent = "Correo o contraseña incorrectos.";
  }
});
