const userGrid = document.getElementsByClassName("table-grid")[0];
const users = null;
var usersInfo;

// Función auto contenida async
(async () => {
    try {
        const res = await fetch(`${APP_ROOT}do_admistarUsuarios.php`);
        // Del response obtenemos el JSON como JS object
        const resObj = await res.json();

        // Establecemos en el HTML element el dato de la fechaHora obtenida.
        if (resObj.ErrMesg) {
            // En caso de recibir un error lo imprimimos
            alert("Hubo un error: ", resObj.ErrMesg);
        } else {
            resObj.forEach(user => {
                const info = `
                    <tr class="user-info" id="user-${user.id}">
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.name}</td>
                        <td>${user.lastname}</td>
                        <td>${user.gender}</td>
                        <td>${user.birthday}</td>
                        <td>${user.is_admin == 1 ? 'Admin' : 'Usuario'}</td>
                        <td>${user.is_active == 1 ? 'Activo' : 'No Activo'}</td>
                        <td><button class="btn-admin" data-id="${user.id}">Administrar</button></td>
                        <td><button class="btn-eliminar" data-id="${user.id}">Eliminar</button></td>
                    </tr>`;
                // Utiliza insertAdjacentHTML para insertar una cadena HTML
                userGrid.insertAdjacentHTML('beforeend', info);
            });

            usersInfo = document.getElementsByClassName("user-info");

            // Agregar manejadores de eventos a los botones
            document.querySelectorAll(".btn-admin").forEach(button => {
                button.addEventListener("click", handleAdmin);
            });

            document.querySelectorAll(".btn-eliminar").forEach(button => {
                button.addEventListener("click", handleEliminar);
            });
        }
    } catch (error) {
        alert("Hubo error al consultar el servidor");
        console.error(error);
    }
})();

// Función para manejar el botón de Administrar
function handleAdmin(event) {
    const userId = event.target.getAttribute("data-id");
    alert(`Administrar usuario con ID: ${userId}`);
    // Aquí puedes redirigir a otra página o mostrar un formulario/modal
}

// Función para manejar el botón de Eliminar
function handleEliminar(event) {
    const userId = event.target.getAttribute("data-id");
    if (confirm(`¿Estás seguro de que deseas eliminar al usuario con ID: ${userId}?`)) {
        // Aquí puedes realizar una solicitud para eliminar el usuario
        fetch(`${APP_ROOT}Controller/eliminarUsuario.php?id=${userId}`, {
            method: "POST"
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Usuario eliminado con éxito");
                // Eliminar la fila del usuario del DOM
                const userRow = document.getElementById(`user-${userId}`);
                if (userRow) {
                    userRow.remove();
                }
            } else {
                alert("Error al eliminar usuario: " + data.message);
            }
        }).catch(error => {
            console.error("Error al eliminar usuario:", error);
            alert("Hubo un error al intentar eliminar al usuario.");
        });
    }
}
