document.addEventListener('DOMContentLoaded', function () {
    const savedTheme = localStorage.getItem('modo-nino');
    if (savedTheme === 'activo') {
        document.body.classList.add('modo-nino');
    } else if (savedTheme === 'modo-joven') {
        document.body.classList.add('modo-joven');
    } else if (savedTheme === 'modo-adulto') {
        document.body.classList.add('modo-adulto');
    }

    function setTheme(theme) {
        if (theme === 'modo-nino') {
            document.body.classList.add('modo-nino');
            document.body.classList.remove('modo-joven');
            document.body.classList.remove('modo-adulto');
            localStorage.setItem('modo-nino', 'activo');
        } else if (theme === 'modo-joven') {
            document.body.classList.add('modo-joven');
            document.body.classList.remove('modo-nino');
            document.body.classList.remove('modo-adulto');
            localStorage.setItem('modo-nino', 'modo-joven');
        } else if (theme === 'modo-adulto') {
            document.body.classList.add('modo-adulto');
            document.body.classList.remove('modo-nino');
            document.body.classList.remove('modo-joven');
            localStorage.setItem('modo-nino', 'modo-adulto');
        } else if (theme === 'modo-normal') {
            document.body.classList.remove('modo-nino');
            document.body.classList.remove('modo-joven');
            document.body.classList.remove('modo-adulto');
            localStorage.setItem('modo-nino', 'inactivo');
        }
    }

    // Agregar un evento click al botón "Nodo Niñ@"
    document.querySelector('#modo-nino-btn').addEventListener('click', function () {
        setTheme('modo-nino');
    });

    // Agregar un evento click al botón "Modo Joven"
    document.querySelector('#modo-joven-btn').addEventListener('click', function () {
        setTheme('modo-joven');
    });

    // Agregar un evento click al botón "Modo Adulto"
    document.querySelector('#modo-adulto-btn').addEventListener('click', function () {
        setTheme('modo-adulto');
    });

    // Agregar un evento click al botón "Modo Normal"
    document.querySelector('#modo-normal-btn').addEventListener('click', function () {
        setTheme('modo-normal');
    });
});
