// custom.js    
// Función para cambiar el tema a naranja
function cambiarTemaNaranja() {
    // Quitamos las clases de colores actuales del body
    document.body.classList.remove('sidebar-dark-primary', 'sidebar-dark-secondary', 'sidebar-dark-info', 'sidebar-dark-danger', 'sidebar-dark-success', 'sidebar-dark-warning');
    // Agregamos la clase de color naranja al body
    document.body.classList.add('sidebar-dark-warning');
  }
  // Llamamos a la función para cambiar el tema cuando la página esté completamente cargada
  document.addEventListener('DOMContentLoaded', function () {
    cambiarTemaNaranja();
  });
