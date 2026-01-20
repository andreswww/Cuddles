<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Cuddles - Sobre Nosotros</title>
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
            .about-collage {
                position: relative;
                width: 100%;
                min-height: 600px;
            }

            .photo-container {
                position: absolute;
                top: 510px;
                left: 50%;
                transform: translateX(-50%);
                width: 300px;
                height: 200px;
                overflow: hidden;
                border: 3px solid #ddd;
                border-radius: 10px;
            }


            .photo-container img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                opacity: 0;
                position: absolute;
                animation: fadeImages 24s infinite;  /* Aquí controlamos la duración del ciclo */
            }

            .photo-container img:nth-child(1) {
                animation-delay: 0s;
            }

            .photo-container img:nth-child(2) {
                animation-delay: 5s;
            }

            .photo-container img:nth-child(3) {
                animation-delay: 10s;
            }

            .photo-container img:nth-child(4) {
                animation-delay: 15s;
            }

            .photo-container img:nth-child(5) {
                animation-delay: 20s;
            }

            .photo-container img:nth-child(6) {
                animation-delay: 25s;
            }

            .photo-container img:nth-child(7) {
                animation-delay: 30s;
            }

            .photo-container img:nth-child(8) {
                animation-delay: 35s;
            }

            .photo-container img:nth-child(9) {
                animation-delay: 40s;
            }

            @keyframes fadeImages {
                0%, 100% {
                    opacity: 0;
                }
                11%, 33% {
                    opacity: 1;
                }
            }

            .about-text {
                font-size: 1.2rem;
                line-height: 1.8;
                margin-top: 30px;
                text-align: justify;
            }

            .about-text h2 {
                font-size: 2.5rem;
                color: #333;
            }

            .page-header {
                background-color: #5D4037;
                color: white;
                text-align: center;
                padding: 50px 0;
            }

            .page-header h1 {
                font-size: 3rem;
                margin-bottom: 10px;
            }

            .page-header .breadcrumb {
                font-size: 1.1rem;
            }
        </style>
    </head>
    <body>

        <!-- Navbar Start -->
        <div class="container-fluid p-0 nav-bar">
            <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
                <a href="index.html" class="navbar-brand px-lg-4 m-0">
                    <h1 class="m-0 display-4 text-uppercase text-white">Cuddles</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto p-4">
                        <a href="index.php" class="nav-item nav-link">Inicioo</a>
                        <a href="nosotros.php" class="nav-item nav-link active">Sobre Nosotros</a>
                        <a href="catologo.php" class="nav-item nav-link">Marchandising</a>
                        <a href="carrito.php" class="nav-item nav-link">Carrito</a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
            <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
                <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Sobre Nosotros</h1>
                <div class="d-inline-flex mb-lg-5">
                    <p class="m-0 text-white"><a class="text-white" href="index.php">Inicio</a></p>
                    <p class="m-0 text-white px-2">/</p>
                    <p class="m-0 text-white">Info</p>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- About Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="section-title">
                    <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;"></h4>
                    <h1 class="display-4">Nuestros Fines, Objetivos y Sueños</h1>
                </div>
                <div class="about-text">
                    <h2>Fines de la Empresa</h2>
                    <p>Cuddles comenzó su viaje en 2024 con el objetivo de ofrecer golosinas de alta calidad que no solo complacen a los paladares, sino que también promueven el bienestar y la alegría. Nuestra misión es crear momentos de felicidad a través de cada producto que elaboramos, asegurándonos de utilizar ingredientes frescos y naturales, y brindando un servicio amable y cercano a todos nuestros clientes.</p>

                    <h2>Objetivos y Visión</h2>
                    <p>La visión de Cuddles ha sido siempre proporcionar un ambiente cálido y amigable, donde cada cliente pueda sentirse como en casa. Queremos ser reconocidos por nuestra dedicación a la calidad y la excelencia en todo lo que hacemos. Además, buscamos expandir nuestra presencia a nivel nacional, asegurándonos de mantener siempre nuestros altos estándares de calidad, ofreciendo una experiencia única que logre emocionar a quienes nos visitan.</p>

                    <h2>Sueños y Realizaciones</h2>
                    <p>Uno de nuestros mayores sueños fue llevar el sabor de Cuddles a más personas alrededor del mundo. Nos llena de orgullo ver cómo nuestra pequeña tienda se ha convertido en un referente para muchos. Hemos logrado crear una comunidad de amantes de la repostería que valoran tanto la calidad de nuestros productos como la calidez de nuestro servicio. En el futuro, aspiramos a seguir innovando y ofreciendo nuevas delicias que nos permitan acercarnos aún más a los corazones de nuestros clientes.</p>

                    <h2>Realización en la Comunidad</h2>
                    <p>Cuddles no solo se dedica a vender golosinas; también está profundamente comprometido con el bienestar de la comunidad. A través de diversas iniciativas, como donaciones a organizaciones locales y la participación en eventos comunitarios, buscamos aportar nuestro granito de arena para hacer del mundo un lugar más dulce y mejor. Creemos que una empresa no solo debe crecer, sino también ayudar a aquellos que la rodean, creando un impacto positivo en la sociedad.</p>
                </div>

                <!-- Recuerdo de fotos en la esquina -->
                <div class="photo-container">
                    <img src="img/fotos/foto1.jpg" alt="Imagen 1">
                    <img src="img/fotos/foto2.jpg" alt="Imagen 2">
                    <img src="img/fotos/foto3.jpg" alt="Imagen 3">
                    <img src="img/fotos/foto4.jpg" alt="Imagen 4">
                    <img src="img/fotos/foto5.jpg" alt="Imagen 5">
                    <img src="img/fotos/foto6.jpg" alt="Imagen 6">
                    <img src="img/fotos/foto7.jpg" alt="Imagen 7">
                    <img src="img/fotos/foto8.jpg" alt="Imagen 8">
                    <img src="img/fotos/foto9.jpg" alt="Imagen 9">
                </div>
            </div>
        </div>
        <!-- About End -->


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

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
