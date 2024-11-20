<?php
    
require_once 'config.php';
require APP_PATH .'db_access/db.php';
    
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userId = intval($_POST['id']);

    eliminar_usuario($userId);
}

function eliminar_usuario($user_id){
    
    if (!$user_id){
        return false;
    }

    $db_conection = getDbConnection();
    $sql = "DELETE FROM `usuarios` WHERE id = ?";
    $stmt = $db_conection->prepare($sql);
    $slqParams = [$user_id];
    $stmt->execute($slqParams);

    echo json_decode([
        'success' => true
    ]);
    
    exit();

}
