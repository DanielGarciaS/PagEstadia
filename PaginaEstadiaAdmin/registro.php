<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // por el momento, solo imprimo los datos enviados por ahora
    echo "<h2>Registro Exitoso</h2>";
    echo "<p>Nombre de usuario: " . htmlspecialchars($_POST["username"]) . "</p>";
    echo "<p>Correo electrónico: " . htmlspecialchars($_POST["email"]) . "</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/estilos;registro.css">
</head>
<body>
    <div class="registro-container">
    <div class="logo-container">
            <img src="logo.jpg" alt="Logo de PsicoAgenda UTSC">
        </div>
        <h1>Registro</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Registrarse</button>
        </form>
    </div>
</body>
</html>
