document.addEventListener('DOMContentLoaded', function () {
    const savedTheme = localStorage.getItem('modo-nino');
    if (savedTheme === 'activo') {
        document.body.classList.add('modo-nino');
    }

    function setTheme(theme) {
        if (theme === 'modo-nino') {
            document.body.classList.add('modo-nino');
            localStorage.setItem('modo-nino', 'activo');
        } else if (theme === 'modo-normal') {
            document.body.classList.remove('modo-nino');
            localStorage.setItem('modo-nino', 'inactivo');
        }
    }

    // Agregar un evento click al botón "Nodo Niñ@"
    document.querySelector('#nodo-nino-btn').addEventListener('click', function () {
        setTheme('modo-nino');
    });

    // Agregar un evento click al botón "Modo Normal"
    document.querySelector('#modo-normal-btn').addEventListener('click', function () {
        setTheme('modo-normal');
    });
});
