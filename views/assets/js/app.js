const crear_usuario = document.querySelector('#crear_usuario');
const editar_usuario = document.querySelector('#editar_usuario');
const btn_eliminar = document.querySelectorAll('#btn_eliminar');
const btn_editar = document.querySelectorAll('#btn_editar');


$(document).ready(function () {
    new DataTable('#tabla-usuarios');
});


crear_usuario.addEventListener('click', function (e) {
    e.preventDefault();
    // Obtener los datos del formulario
    const formData = new FormData(document.getElementById('myForm'));

    // Enviar los datos por POST utilizando fetch
    fetch('./create', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (response.ok) {
                return response.text();
            }
            throw new Error('Error en la solicitud.');
        })
        .then(data => {
            const respuesta = JSON.parse(data); // Si la respuesta es JSON, convertirla en un objeto JavaScript
            if (respuesta.respuesta == "ok") { // Acceder a un valor específico de la respuesta
                $('#modalRegistroUsuario').modal('hide');
                alerts({
                    position: "top-end",
                    icon: 'success',
                    title: 'Exito',
                    text: 'Usuario Creado Correctamente',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                alerts({
                    position: "top-end",
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrio un Error al crear el Usuario',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

editar_usuario.addEventListener('click', function (e) {
    e.preventDefault();
    // Obtener los datos del formulario
    const formData = new FormData(document.getElementById('e_myForm'));
    // Enviar los datos por POST utilizando fetch
    fetch('./update/', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (response.ok) {
                return response.text();
            }
            throw new Error('Error en la solicitud.');
        })
        .then(data => {
            const respuesta = JSON.parse(data); // Si la respuesta es JSON, convertirla en un objeto JavaScript
            if (respuesta.respuesta == "ok") { // Acceder a un valor específico de la respuesta
                $('#modalEditarUsuario').modal('hide');
                alerts({
                    position: "top-end",
                    icon: 'success',
                    title: 'Exito',
                    text: 'Usuario Modificado Correctamente',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                alerts({
                    position: "top-end",
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrio un Error al modificar el Usuario',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

// Escuchar el click en los botones de clase 'btn_eliminar'
btn_eliminar.forEach(btn => {
    btn.addEventListener('click', function () {
        // Obtener el valor del atributo 'id_usuario' del botón actual
        var idUsuario = this.getAttribute('id_usuario');

        // Enviar los datos por POST utilizando fetch
        fetch('./delete/' + idUsuario, {
            method: 'POST',
            body: idUsuario
        })
            .then(response => {
                if (response.ok) {
                    return response.text();
                }
                throw new Error('Error en la solicitud.');
            })
            .then(data => {
                const respuesta = JSON.parse(data); // Si la respuesta es JSON, convertirla en un objeto JavaScript
                if (respuesta.respuesta == "ok") { // Acceder a un valor específico de la respuesta
                    alerts({
                        position: "top-end",
                        icon: 'success',
                        title: 'Exito',
                        text: 'Usuario Eliminado Correctamente',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }else{
                    alerts({
                        position: "top-end",
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrio un Error al eliminar el Usuario',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});

btn_editar.forEach(btn => {
    btn.addEventListener('click', function () {
        // Obtener el valor del atributo 'id_usuario' del botón actual
        var idUsuario = this.getAttribute('e_id_usuario');

        // Enviar los datos por POST utilizando fetch
        fetch('./User/' + idUsuario, {
            method: 'POST',
            body: idUsuario
        })
            .then(response => {
                if (response.ok) {
                    return response.text();
                }
                throw new Error('Error en la solicitud.');
            })
            .then(data => {
                const respuesta = JSON.parse(data); // Si la respuesta es JSON, convertirla en un objeto JavaScript
                if (respuesta.respuesta == "ok") { // Acceder a un valor específico de la respuesta
                    document.querySelector('#e_nombre').value = respuesta.datos.nombres;
                    document.querySelector('#e_apellido').value = respuesta.datos.apellidos;
                    document.querySelector('#e_email').value = respuesta.datos.email;
                    document.querySelector('#e_telefono').value = respuesta.datos.telefono;
                    document.querySelector('#e_id_usuario').value = respuesta.datos.id_usuario;
                }

            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});

const alerts = (alertData) => {
    const {position, icon, title, text, showConfirmButton, timer} = alertData;
    Swal.fire({
        position,
        icon,
        title,
        text,
        showConfirmButton,
        timer,
    }).then((result) => {
        window.location.href = "./"; // Redirigir a la página principal
    });
}
