const idBD = '1';
const passwordBD = '1234';
const login = document.querySelector('#login');

// Eventos
eventListeners();

function eventListeners() {
    login.addEventListener('submit', verificar);
}

function verificar(e) {
    e.preventDefault();
    const idform = document.querySelector('#idEmpleado').value;
    const passwordform = document.querySelector('#password').value;
    if (idform === '') {
        mostrarAlerta('ID Obligatorio', 'error');
    }
    if (passwordform === '') {
        mostrarAlerta('Contraseña Obligatoria', 'error');
    }

    if (idBD !== idform || passwordBD !== passwordform) {
        mostrarAlerta('ID o Contraseña Invalidos', 'error');
    }

    if (idBD === idform && passwordBD === passwordform) {
        window.location.href = "principal.php";
    }

}

function mostrarAlerta(mensaje, tipo) {

    const divMensaje = document.createElement('DIV');
    divMensaje.classList.add('text-center', 'alert');

    if (tipo === 'error') {
        divMensaje.classList.add('error');
    }

    divMensaje.textContent = mensaje;

    // insertamos en el html
    document.querySelector('.login').insertBefore(divMensaje, login);

    //Eliminar la alerta
    setTimeout(() => {
        divMensaje.remove();
    }, 2000);
}