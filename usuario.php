<?php
// Importar la conexión
require 'includes/config/database.php';
$db = conectarDB();

// Crear un email y password
$email = "correo@correo.com";
$password = "123456";

// Hashear el password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";

// Ejecutar el query
mysqli_query($db, $query);

echo "Usuario administrador creado correctamente.";
?>