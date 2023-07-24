function getCurrentHour() {
    return new Date().getHours();
  }
  function toggleTheme() {
    const body = document.querySelector('body');
    const currentHour = getCurrentHour();

    // Las horas para considerar como noche 
    const nightStartHour = 20; // 8:00 PM
    const nightEndHour = 6;    // 6:00 AM

    if (currentHour >= nightStartHour || currentHour < nightEndHour) {
      // Es de noche, habilita el tema oscuro
      body.classList.add('dark-mode');
    } else {
      // Es de día, deshabilita el tema oscuro
      body.classList.remove('dark-mode');
    }
  }

  // Llama a la función para cambiar el tema al cargar la página
  toggleTheme();
