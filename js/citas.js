document.addEventListener('DOMContentLoaded', () => {
  const formularios = document.querySelectorAll('.form-eliminar-cita');
  const mensajeDiv = document.getElementById('mensaje-eliminacion');

  formularios.forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();

      const confirmacion = confirm('¿Estás seguro de que deseas eliminar esta cita?');
      if (!confirmacion) return;

      const formData = new FormData(form);

      fetch(form.action, {
        method: 'POST',
        body: formData
      })
        .then(response => {
          if (!response.ok) throw new Error('Error al eliminar');
          return response.text();
        })
        .then(() => {
          form.closest('tr').remove();
          mostrarMensaje(' Cita eliminada exitosamente.', 'success');
        })
        .catch(() => {
          mostrarMensaje(' Error al eliminar la cita.', 'danger');
        });
    });
  });

  function mostrarMensaje(texto, tipo) {
    if (!mensajeDiv) return;

    mensajeDiv.textContent = texto;
    mensajeDiv.className = 'alert alert-' + tipo;
    mensajeDiv.classList.remove('d-none');

    setTimeout(() => mensajeDiv.classList.add('d-none'), 3000);
  }
});
