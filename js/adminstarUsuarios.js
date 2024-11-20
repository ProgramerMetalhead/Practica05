const userGrid = document.getElementsByClassName("table-grid")[0];
const users = null;
var usersInfo;

// Función auto contenida async
// Función auto contenida async
(async () => {
    try {
        const res = await fetch(`${APP_ROOT}do_admistarUsuarios.php`);
        const resObj = await res.json();

        if (resObj.ErrMesg) {
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
                        <td><button class="btn-admin" data-id="${user.id}" data-role="${user.is_admin}">Administrar</button></td>
                        <td><button class="btn-eliminar" data-id="${user.id}">Eliminar</button></td>
                    </tr>`;
                userGrid.insertAdjacentHTML('beforeend', info);
            });

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

// Función para abrir el modal
function handleAdmin(event) {
    const userId = event.target.getAttribute("data-id");
    const userRole = event.target.getAttribute("data-role");

    document.getElementById("modalUserId").value = userId;
    document.getElementById("modalRole").value = userRole;

    document.getElementById("adminModal").style.display = "flex";
}

// Cerrar el modal
document.getElementById("closeModal").addEventListener("click", () => {
    document.getElementById("adminModal").style.display = "none";
});

// Enviar cambios
document.getElementById("adminForm").addEventListener("submit", async (event) => {
    event.preventDefault();

    const userId = document.getElementById("modalUserId").value;
    const newPassword = document.getElementById("modalPassword").value;
    const newRole = document.getElementById("modalRole").value;

    try {
        const response = await fetch(`${APP_ROOT}Controllers/actualizarUsuario.php`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                id: userId,
                password: newPassword,
                role: newRole,
            }),
        });

        const data = await response.json();

        if (data.success) {
            alert("Usuario actualizado correctamente");
            // Actualizar la tabla
            const row = document.getElementById(`user-${userId}`);
            row.cells[6].textContent = newRole == 1 ? "Admin" : "Usuario";

            document.getElementById("adminModal").style.display = "none";
        } else {
            alert("Error al actualizar usuario: " + data.ErrMesg);
        }
    } catch (error) {
        console.error("Error al actualizar usuario:", error);
        alert("Hubo un error al intentar actualizar el usuario.");
    }
});

// Función para manejar el botón de Eliminar
function handleEliminar(event) {
    const userId = event.target.getAttribute("data-id");
    if (confirm(`¿Estás seguro de que deseas eliminar al usuario con ID: ${userId}?`)) {
        fetch(`${APP_ROOT}Controllers/eliminarUsuario.php?id=${userId}`, {
            method: "POST"
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Usuario eliminado con éxito");
                const userRow = document.getElementById(`user-${userId}`);
                if (userRow) {
                    userRow.remove();
                }
            } else {
                alert("Error al eliminar usuario: " + data.ErrMesg);
            }
        }).catch(error => {
            console.error("Error al eliminar usuario:", error);
            alert("Hubo un error al intentar eliminar al usuario.");
        });
    }
}
