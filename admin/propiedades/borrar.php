<?php
require_once __DIR__ . '/../../includes/funciones.php';

if (!estaAutenticado()) {
    header('Location: /login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/index.php');
    exit;
}

$token = $_POST['csrf'] ?? '';

if (
    !is_string($token) ||
    empty($_SESSION['csrf']) ||
    !hash_equals($_SESSION['csrf'], $token)
) {
    http_response_code(403);
    exit('Solicitud no válida. Regresa al panel e intenta nuevamente.');
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    http_response_code(400);
    exit('ID de propiedad no válido.');
}

require_once __DIR__ . '/../../includes/config/database.php';
$db = conectarDB();

$consulta = mysqli_prepare(
    $db,
    'DELETE FROM propiedades WHERE id_propiedades = ?'
);

mysqli_stmt_bind_param($consulta, 'i', $id);
mysqli_stmt_execute($consulta);

header('Location: /admin/index.php?resultado=3');
exit;