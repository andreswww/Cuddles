<?php
session_start();

// Verifica si el usuario no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirige al login si no está autenticado
    exit();
}

// Obtiene el nombre de usuario de la sesión
$username = $_SESSION['usuario'];

// Conexión a la base de datos
$servername = "localhost";
$username_db = "root"; // Cambia si usas otro usuario
$password_db = "";     // Cambia si tienes una contraseña
$dbname = "Cuddles_BD";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejo de la actualización del carrito (agregar o quitar productos)
if (isset($_POST['action']) && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $action = $_POST['action'];

    // Si la acción es agregar al carrito
    if ($action == 'add') {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            // Obtener producto desde la base de datos
            $sql = "SELECT * FROM Productos WHERE id_producto = '$product_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $_SESSION['cart'][$product_id] = [
                    'name' => $product['nombre'],
                    'price' => $product['precio'],
                    'quantity' => 1,
                    'image' => $product['imagen'] // Suponiendo que la columna 'imagen' existe
                ];
            }
        }
    } elseif ($action == 'remove') {
        unset($_SESSION['cart'][$product_id]);
    } elseif ($action == 'update') {
        $quantity = $_POST['quantity'];
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$product_id]);
        } else {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }
    }
}

// Cálculo del total
$total = 0;
foreach ($_SESSION['cart'] as $product_id => $cart_item) {
    $total += $cart_item['price'] * $cart_item['quantity'];
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cuddles - Carrito</title>

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

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
                <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Tu Carrito</h1>
                <div class="d-inline-flex mb-lg-5">
                    <p class="m-0 text-white"><a class="text-white" href="index.php">Inicio</a></p>
                    <p class="m-0 text-white px-2">/</p>
                    <p class="m-0 text-white">Carrito</p>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Carrito Section Start -->
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="mb-4">Productos en tu Carrito</h2>

                    <?php if (empty($_SESSION['cart'])): ?>
                        <div class="bg-light p-4 rounded shadow-sm">
                            <p class="text-muted">Tu carrito está vacío. Agrega productos para continuar.</p>
                            <a href="catologo.php" class="btn btn-primary">Ver Catálogo</a>
                        </div>
                    <?php else: ?>
                        <form action="carrito.php" method="POST">
                            <div class="bg-light p-4 rounded shadow-sm">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Imagen</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Total</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($_SESSION['cart'] as $product_id => $cart_item): ?>
                                            <tr>
                                                <td><?php echo $cart_item['name']; ?></td>
                                                <td>
                                                    <img src="images/<?php echo $cart_item['image']; ?>" alt="<?php echo $cart_item['name']; ?>" style="width: 50px; height: 50px;">
                                                </td>
                                                <td>
                                                    <input type="number" name="quantity" value="<?php echo $cart_item['quantity']; ?>" min="1" class="form-control" style="width: 80px;">
                                                </td>
                                                <td>$<?php echo number_format($cart_item['price'], 2); ?></td>
                                                <td>
                                                    <button type="submit" name="action" value="update" class="btn btn-warning btn-sm">Actualizar</button>
                                                    <button type="submit" name="action" value="remove" class="btn btn-danger btn-sm">Eliminar</button>
                                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>

                <!-- Resumen -->
                <div class="col-lg-4">
                    <h2 class="mb-4">Resumen de Compra</h2>
                    <div class="bg-light p-4 rounded shadow-sm">
                        <p><strong>Total:</strong> $<?php echo number_format($total, 2); ?></p>
                        <a href="checkout.php" class="btn btn-success btn-block">Proceder al Pago</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carrito Section End -->

        <!-- Footer Start -->
        <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
            <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
                <div class="col-lg-3 col-md-6 mb-5">
                    <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Tiendas Físicas</h4>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>Próximamente...</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+52 3312440955</p>
                    <p class="m-0"><i class="fa fa-envelope mr-2"></i>cuddlesbussines@gmail.com</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-5">
                    <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Síguenos</h4>
                    <div class="d-flex justify-content-start">
                        <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-outline-light btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-5">
                    <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Horarios</h4>
                    <div>
                        <h6 class="text-white text-uppercase">Lunes - Viernes</h6>
                        <p>8.00 AM - 8.00 PM</p>
                        <h6 class="text-white text-uppercase">Sábado - Domingo</h6>
                        <p>2.00 PM - 8.00 PM</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-5">
                    <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Novedades</h4>
                    <p>Recibe nuestras últimas ofertas y novedades.</p>
                    <div class="w-100">
                        <div class="input-group">
                            <input type="text" class="form-control border-light" style="padding: 25px;" placeholder="Tu correo">
                            <div class="input-group-append">
                                <button class="btn btn-primary font-weight-bold px-3">Suscribirse</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
                <p class="mb-2 text-white">Copyright &copy; <a class="font-weight-bold" href="#">Cuddles</a>. Todos los derechos reservados.</p>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
