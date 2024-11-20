<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?=APP_ROOT?>css/style.css" rel="stylesheet" type="text/css" /> 
    <script src="<?=APP_ROOT?>js/config.js"></script>
    <title>Administar Usuarios</title>
</head>
<body>
<div class="header">
    <h1>Practica 05</h1>
    </div>
      
    <?php require APP_PATH . "html_parts/menu.php"; ?>
      
    <div class="row">

        <div class="leftcolumn">

            <div class="card">
                <h2>Sistema de Usuario</h2>
                <h5>Administra el Registro de Usuarios:</h5>
                <form id="register-user">
                    <table class="table-grid">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Lastname</th>
                            <th>Gender</th>
                            <th>Birthday</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Administar</th>
                            <th>Borrar</th>
                        </tr>
                    </table>
                </form>
            </div>
        </div>  <!-- End left column -->
    </div>  <!-- End row-->

    <!--modal-->
    <div id="adminModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center;">
        <div style="background: #fff; padding: 20px; border-radius: 5px; width: 300px;">
            <h2>Administrar Usuario</h2>
            <form id="adminForm">
                <input type="hidden" id="modalUserId" />
                <div>
                    <label for="modalPassword">Nuevo Password:</label>
                    <input type="password" id="modalPassword" placeholder="Ingrese nuevo password" />
                </div>
                <div>
                    <label for="modalRole">Nuevo Rol:</label>
                    <select id="modalRole">
                        <option value="0">Usuario</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <button type="submit">Guardar Cambios</button>
            </form>
            <button id="closeModal">Cerrar</button>
        </div>
    </div>


    <script src="<?=APP_ROOT?>js\adminstarUsuarios.js"></script>
</body>
</html>