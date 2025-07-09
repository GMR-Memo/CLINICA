document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formCita');

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const paciente = document.getElementById('paciente').value.trim();
    const fecha = document.getElementById('fecha').value;
    const hora = document.getElementById('hora').value;
    const motivo = document.getElementById('motivo').value.trim();

    if (!paciente || !fecha || !hora || !motivo) {
      alert('Por favor, completa todos los campos.');
      return;
    }

    const fechaActual = new Date();
    const fechaSeleccionada = new Date(fecha + 'T' + hora);
    if (fechaSeleccionada < fechaActual) {
      alert('La fecha y hora de la cita no pueden ser en el pasado.');
      return;
    }


    alert('Cita agendada exitosamente.');
    form.reset();
  });
});
