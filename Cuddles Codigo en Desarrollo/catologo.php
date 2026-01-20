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
$username_db = "root";  // Cambia si usas otro usuario
$password_db = "";      // Cambia si tienes una contraseña
$dbname = "Cuddles_BD";

// Crear la conexión
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los productos de la base de datos
$sql = "SELECT * FROM Productos ORDER BY id_producto ASC LIMIT 3";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cuddles - Marchandising</title>

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

        <!-- Custom CSS to handle image size and proportion -->
        <style>
            .card-img-top {
                width: 100%;
                height: 250px; /* Asegura que todas las imágenes tengan la misma altura */
                object-fit: cover; /* Mantiene la proporción de la imagen recortada si es necesario */
            }

            /* Animación de agrandamiento al pasar el ratón */
            .product-card {
                transition: transform 0.3s ease-in-out;
                cursor: pointer;
            }

            .product-card:hover {
                transform: scale(1.05); /* Agranda el producto en un 5% */
            }

            /* Modificación del tamaño del modal */
            .modal-dialog {
                max-width: 900px; /* Hacemos la ventana emergente más grande */
                transition: transform 0.5s ease-in-out; /* Animación de entrada */
            }

            .modal-content {
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }

            /* Efecto de transición suave en el modal */
            .modal.fade .modal-dialog {
                transform: translateY(-50px); /* Inicia ligeramente desplazado hacia arriba */
                opacity: 0; /* Inicialmente oculto */
            }

            .modal.show .modal-dialog {
                transform: translateY(0); /* Se mueve hacia su posición final */
                opacity: 1; /* Se vuelve completamente visible */
            }

            /* Animación del contenido del modal */
            .modal-body {
                display: flex;
                align-items: center;
                transition: transform 0.3s ease-out;
            }

            .modal-body img {
                width: 250px;
                height: 250px;
                object-fit: cover;
                margin-right: 20px;
            }

            .modal-body .product-details {
                flex: 1;
            }

            .modal-footer {
                justify-content: space-between;
            }

            .modal-footer .btn {
                width: 48%;
            }

            /* Estilos para la navbar y otros elementos */
            .nav-item {
                font-weight: 500;
            }

            .nav-item:hover {
                color: #f8f9fa !important;
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
                        <a href="index.php" class="nav-item nav-link">Inicio</a>
                        <a href="nosotros.php" class="nav-item nav-link">Sobre Nosotros</a>
                        <a href="catalogo.php" class="nav-item nav-link active">Merchandising</a>
                        <a href="carrito.php" class="nav-item nav-link">Carrito</a>
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
                <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Merchandising</h1>
                <div class="d-inline-flex mb-lg-5">
                    <p class="m-0 text-white"><a class="text-white" href="index.php">Inicio</a></p>
                    <p class="m-0 text-white px-2">/</p>
                    <p class="m-0 text-white">Merchandising</p>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Marcha Start -->
        <div class="container py-5">
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    // Muestra cada producto
                    while ($row = $result->fetch_assoc()) {
                        // Asocia una imagen a cada producto
                        $productImage = "img/" . $row['id_producto'] . ".jpg"; // Usamos el id_producto para identificar la imagen
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
        <!-- Mercha End -->

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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Añadir al Carrito</button>
                        <button type="button" class="btn btn-success">Pagar Ahora</button>
                    </div>
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

        <!-- JS Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


        <script>
            // Al hacer clic en un producto, cargar los detalles en el modal
            $('#productModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Elemento que activó el modal
                var productId = button.data('id');
                var productName = button.data('nombre');
                var productPrice = button.data('precio');
                var productDescription = button.data('descripcion');

                var modal = $(this);
                modal.find('#modal-product-name').text(productName);
                modal.find('#modal-product-price').text('$' + productPrice);
                modal.find('#modal-product-description').text(productDescription);
                modal.find('#modal-product-image').attr('src', 'img/' + productId + '.jpg');

                // Activar animación de aparición suave
                modal.find('.modal-dialog').css({
                    'transform': 'translateY(0)',
                    'opacity': '1'
                });
            });
        </script>
    </body>

</html>
