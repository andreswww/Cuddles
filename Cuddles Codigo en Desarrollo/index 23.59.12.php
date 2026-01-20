<?php
session_start();

// Verifica si el usuario no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirige al login si no está autenticado
    exit();
}

// Procesa el cierre de sesión
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php"); // Redirige al login al cerrar sesión
    exit();
}   

// Obtiene el nombre de usuario de la sesión
$username = $_SESSION['usuario'];

// Conexión a la base de datos
$servername = "localhost";
$username_db = "root";  // Cambia si usas otro usuario
$password_db = "";      // Cambia si tienes una contraseña
$dbname = "Cuddles_BD";

// Crear la conexión
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los últimos tres productos de la base de datos
$sql = "SELECT * FROM Productos ORDER BY id_producto DESC LIMIT 3";
$result = $conn->query($sql);

// Verificar si se ha enviado un producto al carrito
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    // Si el carrito no está creado, lo inicializamos como un array vacío
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Añadimos el producto al carrito
    $_SESSION['cart'][] = [
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice
    ];

    // Mostrar mensaje emergente
    echo "<script>alert('Producto añadido al carrito');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Cuddles - Inicio</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

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

        <style>
            /* Estilo para los productos */
            .card-img-top {
                width: 100%;
                height: 250px;
                object-fit: cover;
            }

            .product-card {
                transition: transform 0.3s ease-in-out;
                cursor: pointer;
            }

            .product-card:hover {
                transform: scale(1.05);
            }

            .modal-dialog {
                max-width: 900px;
                transition: transform 0.5s ease-in-out;
            }

            .modal-body {
                display: flex;
                align-items: center;
            }

            .modal-body img {
                width: 250px;
                height: 250px;
                object-fit: cover;
                margin-right: 20px;
            }

            .modal-footer {
                justify-content: space-between;
            }

            .modal-footer .btn {
                width: 48%;
            }
        </style>
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
                        <a href="index.php" class="nav-item nav-link active">Inicio</a>
                        <a href="nosotros.php" class="nav-item nav-link">Sobre Nosotros</a>
                        <a href="catologo.php" class="nav-item nav-link">Merchandising</a>
                        <a href="carrito.php" class="nav-item nav-link">Carrito</a>
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

        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="img/Portada Cuddles.png" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <h2 class="text-primary font-weight-medium m-0">Los mejores dulces</h2>
                            <h1 class="display-1 text-white m-0"></h1>
                            <h2 class="text-white m-0">* Desde 2024 *</h2>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" src="img/Portada Cuddles.png" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <h2 class="text-primary font-weight-medium m-0">Los mejores dulces</h2>
                            <h1 class="display-1 text-white m-0"></h1>
                            <h2 class="text-white m-0">*Desde 2024 *</h2>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
        <!-- Carousel End -->

        <!-- Productos Start -->
        <div class="container py-5">
            <h2 class="text-center mb-4">Golosinas</h2>
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $productImage = "img/" . $row['id_producto'] . ".jpg";
                        echo '<div class="col-lg-4 col-md-6 mb-4">';
                        echo '<div class="card h-100 border-0 shadow product-card" data-toggle="modal" data-target="#productModal" data-id="' . $row['id_producto'] . '" data-nombre="' . htmlspecialchars($row['nombre']) . '" data-precio="' . $row['precio'] . '" data-descripcion="' . htmlspecialchars($row['descripcion']) . '">';
                        echo '<img class="card-img-top" src="' . $productImage . '" alt="Producto">';
                        echo '<div class="card-body text-center">';
                        echo '<h5 class="card-title">' . htmlspecialchars($row['nombre']) . '</h5>';
                        echo '<p class="card-text text-muted">$' . number_format($row['precio'], 2) . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "No hay productos disponibles.";
                }
                ?>
            </div>
        </div>
        <!-- Productos End -->

        <!-- Modal para mostrar detalles del producto -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Detalles del Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="modal-product-image" src="" alt="Producto">
                        <div class="product-details">
                            <h5 id="modal-product-name"></h5>
                            <p id="modal-product-price"></p>
                            <p id="modal-product-description"></p>
                        </div>
                    </div>
                    <form method="POST" action="index.php">
                        <div class="modal-footer">
                            <input type="hidden" id="product_id" name="product_id">
                            <input type="hidden" id="product_name" name="product_name">
                            <input type="hidden" id="product_price" name="product_price">
                            <button type="submit" name="add_to_cart" class="btn btn-primary">Añadir al Carrito</button>
                            <button type="button" class="btn btn-success">Pagar Ahora</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <script>
            // Modal de producto
            $('#productModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var productId = button.data('id');
                var productName = button.data('nombre');
                var productPrice = button.data('precio');
                var productDescription = button.data('descripcion');
                var productImage = "img/" + productId + ".jpg";

                var modal = $(this);
                modal.find('.modal-title').text('Detalles del Producto: ' + productName);
                modal.find('#modal-product-name').text(productName);
                modal.find('#modal-product-price').text('$' + productPrice);
                modal.find('#modal-product-description').text(productDescription);
                modal.find('#modal-product-image').attr('src', productImage);

                // Establecer los valores ocultos del formulario
                modal.find('#product_id').val(productId);
                modal.find('#product_name').val(productName);
                modal.find('#product_price').val(productPrice);
            });
        </script>
    </body>
</html>

<?php $conn->close(); ?>
