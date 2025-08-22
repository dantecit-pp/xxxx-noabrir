<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
</head>
<body>

    <h1>Reporte de Ventas</h1>

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

    // Consulta para obtener la suma, mínimo y máximo en una sola llamada
    $sql = "SELECT SUM(monto) AS total_ventas, MIN(monto) AS venta_minima, MAX(monto) AS venta_maxima FROM ventas";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $datos = $resultado->fetch_assoc();
        
        $total_ventas = floatval($datos['total_ventas']);
        $venta_minima = floatval($datos['venta_minima']);
        $venta_maxima = floatval($datos['venta_maxima']);

        $iva_total = $total_ventas * 0.21;

        echo "<p><strong>Suma Total de Ventas:</strong> $" . number_format($total_ventas, 2) . "</p>";
        echo "<p><strong>Cálculo del IVA (21%):</strong> $" . number_format($iva_total, 2) . "</p>";
        echo "<p><strong>Venta Mínima:</strong> $" . number_format($venta_minima, 2) . "</p>";
        echo "<p><strong>Venta Máxima:</strong> $" . number_format($venta_maxima, 2) . "</p>";

    } else {
        echo "<p>No se encontraron registros de ventas para generar el reporte.</p>";
    }

    // Cerrar conexión
    $conexion->close();
    ?>
    <p><a href="formulario.html">Ingresar otra venta</a></p>

</body>
</html>