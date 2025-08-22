<?php
 $host = "localhost";
    $usuario = "root"; 
    $clave = "";     
    $bd = "laboratorio_bd";

    $conexion = new mysqli($host, $usuario, $clave, $bd);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    
$sql = "SELECT id, fecha, cliente, monto FROM ventas ORDER BY fecha DESC";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Fecha</th><th>Cliente</th><th>Monto</th></tr>";
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['fecha'] . "</td>";
        echo "<td>" . $fila['cliente'] . "</td>";
        echo "<td>" . $fila['monto'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No hay ventas registradas.";
}

$conexion->close();
?>