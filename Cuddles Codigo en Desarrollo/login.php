<?php
session_start(); // Iniciar sesión

// Si ya hay una sesión activa, redirige al index
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

require 'config.php'; // Incluir la configuración de base de datos

// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los valores del formulario
    $nombre = $_POST['username'] ?? '';
    $contrasena = $_POST['password'] ?? '';

    // Escapar los valores para evitar inyecciones SQL
    $nombre = mysqli_real_escape_string($con, $nombre);
    $contrasena = mysqli_real_escape_string($con, $contrasena);

    // Consulta SQL para verificar las credenciales del usuario
    $query = "SELECT nombre, contrasena
              FROM Usuarios  
              WHERE nombre = '$nombre' 
              AND contrasena = '$contrasena'"; 

    // Ejecutar la consulta
    $resp = mysqli_query($con, $query);

    // Verificar si la consulta fue exitosa
    if (!$resp) {
        die("Error en la consulta: " . mysqli_error($con));
    }

    // Si la consulta devuelve un registro, el login es exitoso
    if (mysqli_num_rows($resp) == 1) {
        // Guardar el nombre de usuario en la sesión
        $_SESSION['usuario'] = $nombre;

        // Redirigir al usuario a index.php
        header("Location: index.php");
        exit;
    } else {
        $error = "Credenciales incorrectas. Por favor, intenta de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Iniciar Sesión - Cuddles</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('img/Portada Cuddles.png');
            background-size: cover;
            background-position: center;
            position: fixed;
            width: 100%;
            height: 100%;
        }
        body::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: inherit;
            background-size: cover;
            background-position: center;
            filter: blur(5px);
            z-index: -1;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .login-container h3 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
        }
        .btn-primary {
            background-color: #333;
            border-color: #333;
            font-family: 'Montserrat', sans-serif;
            width: 100%;
            padding: 10px;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #555;
            border-color: #555;
        }
        .alert-danger {
            background-color: #f44336;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>Iniciar Sesión</h3>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Nombre de usuario</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
