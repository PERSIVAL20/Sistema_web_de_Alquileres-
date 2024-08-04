<?php
include("config.php");

$host = "localhost";
$usuario_bd = "Kimberly";
$contrasena_bd = "7idbd]JSpw(sT)jl";
$nombre_bd = "bd_prueba";
$conn = mysqli_connect($host, $usuario_bd, $contrasena_bd, $nombre_bd);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Hacer el query con el select
$query = "SELECT * FROM registros";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/listas.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Alquileres</title>
</head>
<body>
    <!-- Menú -->
    <div class="icon-bar">
        <a href="inicioAlquiler.php"><i class="fa fa-home"></i></a>
    </div>
    
    <h2>Alquileres</h2>
    <hr>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Cédula</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Teléfonos</th>
                        <th scope="col">Fecha de Inicio</th>
                        <th scope="col">Fecha de Finalización</th>
                        <th scope="col">Total en dolares</th> <!-- Nueva columna -->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Iterar sobre los resultados
                    while ($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        // Comprobar si las claves existen en el array
                        if (isset($fila['fecha_inicio']) && isset($fila['fecha_finalizacion'])) {
                            $ID = $fila['ID'];

                            // Calcular la diferencia en días entre la fecha de inicio y la fecha de finalización
                            $fecha_inicio = new DateTime($fila['fecha_inicio']);
                            $fecha_finalizacion = new DateTime($fila['fecha_finalizacion']);
                            $diferencia = $fecha_finalizacion->diff($fecha_inicio);
                            $dias = $diferencia->days;

                            // Calcular el total
                            $total = $dias * 22.50;
                        } else {
                            $dias = 0;
                            $total = 0;
                        }
                    ?>
                    <tr>
                        <td><?php echo $fila['cedula']; ?></td>
                        <td><?php echo $fila['nombres']; ?></td>
                        <td><?php echo $fila['apellidos']; ?></td>
                        <td><?php echo $fila['email']; ?></td>
                        <td><?php echo $fila['telefono']; ?></td>
                        <td><?php echo $fila['fecha_inicio']; ?></td>
                        <td><?php echo $fila['fecha_finalizacion']; ?></td>
                        <td><?php echo $total; ?></td> <!-- Mostrar el total -->
                    </tr>
                    <?php  
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
