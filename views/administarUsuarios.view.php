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
    <script src="<?=APP_ROOT?>js\adminstarUsuarios.js"></script>
</body>
</html>