<?php
// Datos de conexión a MySQL
$host = "localhost";
$usuario = "root";
$clave = "";
$bd = "laboratorio_bd";

// Crear conexión
$conexion = new mysqli($host, $usuario, $clave, $bd);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$fecha = $_POST['fecha'];
$cliente = $_POST['cliente'];
$monto = $_POST['monto'];

// Validar datos mínimos
if (empty($fecha) || empty($cliente) || empty($monto)) {
    die("Por favor, complete todos los campos.");
}

// Insertar datos en la tabla ventas
$sql = "INSERT INTO ventas (fecha, cliente, monto) VALUES ('$fecha', '$cliente', '$monto')";

if ($conexion->query($sql) === TRUE) {
    // Obtener el ID de la última venta insertada
    $last_id = $conexion->insert_id;

    // Mostrar los datos ingresados al usuario
    echo "<h2>Venta registrada con éxito.</h2>";
    echo "<p><strong>ID de Venta:</strong> " . $last_id . "</p>";
    echo "<p><strong>Fecha:</strong> " . $fecha . "</p>";
    echo "<p><strong>Cliente:</strong> " . $cliente . "</p>";
    echo "<p><strong>Monto:</strong> $" . $monto . "</p>";
    
    echo "<p><a href='formulario.html'>Ingresar otra venta</a></p>";
    echo "<p><a href='http://localhost/phpmyadmin'>Ver en phpMyAdmin</a></p>";
} else {
    echo "Error al guardar la venta: " . $conexion->error;
}

// Cerrar conexión
$conexion->close();
?>