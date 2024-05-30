<?php
session_start();

// Datos de ejemplo (momentaneos hasta tener bd)
$usuario_correcto = 'dani';
$password_correcto = '178989';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $usuario_correcto && $password === $password_correcto) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
    } else {
        $mensaje = "Nombre de usuario o contraseña incorrectos.";
        $tipo_mensaje = "error";
    }
} else {
    $mensaje = "Método de solicitud no permitido.";
    $tipo_mensaje = "error";
}
?>

