<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Ventas</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Fondo gris claro */
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Alinea al inicio para que el contenido no esté pegado al centro vertical */
            min-height: 100vh;
            box-sizing: border-box;
        }

        .container {
            background-color: #ffffff; /* Fondo blanco para el contenedor principal */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            width: 100%;
            max-width: 800px; /* Ancho máximo para el contenido */
            box-sizing: border-box;
            margin-top: 20px; /* Espacio superior para que no esté pegado al borde */
        }

        h1 {
            color: #333; /* Color de texto oscuro */
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 1px solid #eee; /* Línea divisoria sutil */
            padding-bottom: 15px;
        }

        /* Estilos para enlaces */
        .links-group {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .links-group a {
            display: inline-block; /* Permite que los enlaces estén en la misma línea */
            background-color: #6c757d; /* Gris secundario */
            color: white;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .links-group a:hover {
            background-color: #5a6268; /* Gris más oscuro al pasar el ratón */
        }

        /* Estilos para la tabla */
        .table-responsive {
            overflow-x: auto; /* Permite el scroll horizontal en tablas grandes */
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse; /* Elimina el espacio entre los bordes de las celdas */
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd; /* Borde inferior de celda */
        }

        table th {
            background-color: #e9ecef; /* Fondo gris claro para encabezados */
            color: #495057; /* Color de texto oscuro */
            font-weight: bold;
        }

        table tbody tr:hover {
            background-color: #f2f2f2; /* Fondo más claro al pasar el ratón */
        }

        /* Estilos para mensajes de sin datos */
        .no-data {
            text-align: center;
            font-style: italic;
            color: #777;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            margin-top: 20px;
        }

        /* Media Queries para responsividad */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin-top: 10px;
            }

            h1 {
                font-size: 1.8em;
                margin-bottom: 20px;
            }

            .links-group a {
                display: block; /* Enlaces apilados en pantallas pequeñas */
                margin: 10px auto;
                width: 90%;
            }

            table th, table td {
                padding: 8px 10px;
                font-size: 0.9em;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.5em;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Listado de Ventas</h1>

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
            echo "<p class='no-data'>Error de conexión: " . $conexion->connect_error . "</p>";
        } else {
            // Consulta para obtener todas las ventas
            $sql = "SELECT id, fecha, cliente, monto FROM ventas ORDER BY fecha DESC, id DESC";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                echo "<div class='table-responsive'>";
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Fecha</th>";
                echo "<th>Cliente</th>";
                echo "<th>Monto</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                
                // Mostrar cada venta en una fila de la tabla
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['cliente']) . "</td>";
                    echo "<td>$" . number_format($fila['monto'], 2) . "</td>";
                    echo "</tr>";
                }
                
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
                
                // Mostrar estadísticas básicas
                $sql_stats = "SELECT COUNT(*) as total_ventas, SUM(monto) as total_monto FROM ventas";
                $result_stats = $conexion->query($sql_stats);
                $stats = $result_stats->fetch_assoc();
                
                echo "<div style='text-align: center; margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 4px;'>";
                echo "<p><strong>Total de ventas:</strong> " . $stats['total_ventas'] . "</p>";
                echo "<p><strong>Monto total:</strong> $" . number_format($stats['total_monto'], 2) . "</p>";
                echo "</div>";
                
            } else {
                echo "<p class='no-data'>No hay ventas registradas.</p>";
            }

            // Cerrar conexión
            $conexion->close();
        }
        ?>

        <div class="links-group">
            <a href="formulario.html">Ingresar nueva venta</a>
            <a href="reporte_ventas.php">Ver Reporte de Ventas</a>
        </div>
    </div>
</body>
</html>
