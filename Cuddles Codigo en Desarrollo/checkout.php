<?php
session_start();

// Verifica si el usuario no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirige al login si no está autenticado
    exit();
}

// Obtiene el nombre de usuario de la sesión
$username = $_SESSION['usuario'];

// Verifica si el carrito está vacío
if (empty($_SESSION['cart'])) {
    header("Location: carrito.php"); // Redirige al carrito si no hay productos
    exit();
}

// Cálculo del total
$total = 0;
foreach ($_SESSION['cart'] as $cart_item) {
    $total += $cart_item['price'] * $cart_item['quantity'];
}

// Si el formulario de compra es enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finalizar'])) {
    // Generar contenido del ticket
    $ticket = "------- TICKET DE COMPRA -------\n";
    $ticket .= "Nombre del Comprador: " . $username . "\n";
    $ticket .= "Fecha: " . date("d-m-Y H:i:s") . "\n";
    $ticket .= "--------------------------------\n";
    foreach ($_SESSION['cart'] as $cart_item) {
        $ticket .= "Producto: " . $cart_item['name'] . "\n";
        $ticket .= "Cantidad: " . $cart_item['quantity'] . "\n";
        $ticket .= "Precio: $" . number_format($cart_item['price'], 2) . "\n";
        $ticket .= "Subtotal: $" . number_format($cart_item['price'] * $cart_item['quantity'], 2) . "\n";
        $ticket .= "--------------------------------\n";
    }
    $ticket .= "TOTAL A PAGAR: $" . number_format($total, 2) . "\n";
    $ticket .= "Gracias por tu compra en Cuddles!\n";

    // Crear el archivo .txt con el ticket
    $file_name = "ticket_de_compra_" . date("YmdHis") . ".txt";
    file_put_contents($file_name, $ticket); // Guardar el ticket en el archivo

    // Limpiar el carrito después de la compra
    unset($_SESSION['cart']);
     echo "<script>
        window.location.href = 'carrito.php'; // Redirige al carrito
    </script>";
    // Forzar la descarga del archivo
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $file_name . '"');
    echo $ticket; // Mostrar el contenido del ticket

    // Forzar la redirección después de la descarga (de forma inmediata)
    // Usamos la función exit() para asegurar que la ejecución del código se detenga
   

    exit(); // Detiene la ejecución del script después de la descarga
}

// Cancelar la compra
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancelar'])) {
    unset($_SESSION['cart']); // Eliminar el carrito
    echo "<script>window.location.href = 'carrito.php';</script>"; // Redirigir al carrito
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuddles - Pagos</title>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.php" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">Cuddles</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="index.php" class="nav-item nav-link">Inicio</a>
                    <a href="about.php" class="nav-item nav-link">Sobre Nosotros</a>
                    <a href="catologo.php" class="nav-item nav-link">Merchandising</a>
                    <a href="carrito.php" class="nav-item nav-link active">Carrito</a>

                    <!-- Menú de usuario -->
                    <div class="nav-item dropdown user-dropdown">
                        <a class="nav-link text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo htmlspecialchars($username); ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <form method="POST">
                                <button type="submit" name="logout" class="dropdown-item" style="background:none; border:none;">Cerrar sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Sección de Pago</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="index.php">Inicio</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Pagos</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container py-5">
        <h2 class="mb-4">Confirmar Compra</h2>

        <div class="row">
            <div class="col-lg-8">
                <h3>Detalles del Pedido</h3>
                <div class="bg-light p-4 rounded shadow-sm">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $cart_item): ?>
                                <tr>
                                    <td><?php echo $cart_item['name']; ?></td>
                                    <td><?php echo $cart_item['quantity']; ?></td>
                                    <td>$<?php echo number_format($cart_item['price'], 2); ?></td>
                                    <td>$<?php echo number_format($cart_item['price'] * $cart_item['quantity'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <h3>Detalles de Pago</h3>
                <div class="bg-light p-4 rounded shadow-sm">
                    <p><strong>Total a Pagar:</strong> $<?php echo number_format($total, 2); ?></p>
                    <p><strong>Tiempo Estimado de Entrega:</strong> <?php echo $tiempo_entrega; ?></p>
                    <form method="POST">
                        <div class="form-group">
                            <label for="direccion">Dirección de Envío</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="numero">Número de Teléfono</label>
                            <input type="text" class="form-control" id="numero" name="numero" required>
                        </div>
                        <button type="submit" name="finalizar" class="btn btn-primary btn-block">Finalizar Compra</button>
                        <button type="submit" name="cancelar" class="btn btn-danger btn-block">Cancelar Compra</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 py-5">
        <div class="container text-center">
            <p class="m-0">&copy; 2025 Cuddles. Todos los derechos reservados.</p>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
