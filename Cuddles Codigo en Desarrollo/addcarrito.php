<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Verifica si el carrito ya existe
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Añadir el producto al carrito
        $_SESSION['cart'][$productId] = $quantity;

        echo "Producto añadido al carrito";
    } else {
        echo "Faltan parámetros.";
    }
}
?>
