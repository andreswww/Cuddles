<?php
session_start();

// Verifica si el usuario no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Verifica si el ticket existe en la sesión
if (!isset($_SESSION['ticket'])) {
    echo "No se encontró el ticket.";
    exit();
}

// Obtiene el ticket desde la sesión
$ticket = $_SESSION['ticket'];

// Establecer las cabeceras para la descarga del archivo
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="ticket_de_compra.txt"');
echo $ticket;

// Limpiar el carrito y el ticket después de la descarga
unset($_SESSION['cart']);
unset($_SESSION['ticket']);

// Redirigir al carrito después de la descarga
echo "<script>
    alert('¡Compra finalizada con éxito! Se descargó tu ticket.');
    window.location.href = 'index.php'; // Redirige al carrito
</script>";
exit();
?>
