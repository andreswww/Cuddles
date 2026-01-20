<?php
session_start();

// Si no hay productos en el carrito, redirigir a la página principal
if (empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit();
}

echo "<h2>Proceso de pago</h2>";
echo "<p>Aquí podrás completar tu compra.</p>";
?>
