<?php

require 'config.php';
require APP_PATH . 'data_access/db.php';
require APP_PATH . 'administarUsuarios_helper.php';

// Ejecuta la consulta hacia la base de datos
db_get_users();

