<?php 
    require_once APP_PATH . "session.php";
    require APP_PATH . "Controllers/validar_admin.php"; 
?>

<div class="topnav">
    <?php if ($USUARIO_AUTENTICADO): ?>
        <a href="<?=APP_ROOT?>">Home</a>
        <a href="<?=APP_ROOT?>enviar_datos_con_form.php">Enviar Datos<br />con form</a>
        <a href="<?=APP_ROOT?>enviar_datos_con_ajax.php">Enviar Datos<br /> con AJAX</a>
        <?php if (validar_admin($_SESSION['Usuario_Id'])): ?>
            <a href="<?=APP_ROOT?>administrarUsuarios.php">Administar<br /> Usuarios</a>
        <?php endif; ?>   
        <a href="#" style="float:right">Link</a>
    <?php else: ?>
        <a href="<?=APP_ROOT . "login.php"?>">Login</a>
    <?php endif; ?>
</div>
