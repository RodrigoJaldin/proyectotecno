// darkmode.js

// Función para cambiar el tema según la hora del día
function setThemeByTime() {
    const date = new Date();
    const currentHour = date.getHours();
    const body = document.querySelector('body');
    const tables = document.querySelectorAll('table');
    const modals = document.querySelectorAll('.modal'); // Agrega esta línea para seleccionar todos los modales

    // Define las horas en las que se considera "modo noche" (por ejemplo, de 19:00 a 7:00)
    const nightStartHour = 19;
    const nightEndHour = 7;

    if (currentHour >= nightStartHour || currentHour < nightEndHour) {
      // Cambia a modo noche
      body.classList.add('night-mode');
      // Agrega una clase 'night-mode' a todas las tablas cuando el modo noche está activo
      tables.forEach(table => table.classList.add('night-mode'));
      // Agrega una clase 'night-mode' a todos los modales cuando el modo noche está activo
      modals.forEach(modal => modal.classList.add('night-mode'));
    } else {
      // Cambia a modo día
      body.classList.remove('night-mode');
      // Elimina la clase 'night-mode' de todas las tablas cuando el modo día está activo
      tables.forEach(table => table.classList.remove('night-mode'));
      // Elimina la clase 'night-mode' de todos los modales cuando el modo día está activo
      modals.forEach(modal => modal.classList.remove('night-mode'));
    }
  }

  // Llamada inicial a la función para establecer el tema al cargar la página
  setThemeByTime();

  // Llama a la función cada minuto para actualizar el tema en caso de cambio de hora
  setInterval(setThemeByTime, 60000);
