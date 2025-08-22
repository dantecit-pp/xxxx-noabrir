<?php

// Datos de conexión a MySQL

$host = "localhost";

$usuario = "root"; // usuario por defecto de XAMPP

$clave = ""; // contraseña vacía por defecto

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

echo "<h2>Venta registrada con éxito.</h2>";

echo "<p><a href='formulario.html'>Ingresar otra venta</a></p>";

echo "<p><a href='http://localhost/phpmyadmin'>Ver en phpMyAdmin</a></p>";

} else {

echo "Error al guardar la venta: " . $conexion->error;

}


// Cerrar conexión

$conexion->close();

?>