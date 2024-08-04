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
$query = "SELECT * FROM alquiler";
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
        <a href="inicio.php"><i class="fa fa-home"></i></a>
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
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Realizar la consulta para obtener los datos
                    $query = "SELECT * FROM registros";
                    $execute = mysqli_query($conn, $query) or die(mysqli_error($conn));

                    // Iterar sobre los resultados
                    while ($fila = mysqli_fetch_array($execute)) {
                        $ID = $fila['ID'];
                    ?>
                    <tr>
                        <td><?php echo $fila['cedula']; ?></td>
                        <td><?php echo $fila['nombres']; ?></td>
                        <td><?php echo $fila['apellidos']; ?></td>
                        <td><?php echo $fila['email']; ?></td>
                        <td><?php echo $fila['telefono']; ?></td>
                        <td><?php echo $fila['fecha_inicio']; ?></td>
                        <td><?php echo $fila['fecha_finalizacion']; ?></td>
                        <td>
                            <form action="edicion.php" method="post">
                                <input type="hidden" name="ID" value="<?php echo $fila['ID']; ?>">
                                <button type="submit" style="background: none; border: none; padding: 0; margin: 0; cursor: pointer;">
                                    <img src='./images/icons8-Edit-32.png' alt='Edit'>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="confirmacion.php" method="post">
                                <input type="hidden" name="ID" value="<?php echo $fila['ID']; ?>">
                                <button type="submit" style="background: none; border: none; padding: 0; margin: 0; cursor: pointer;">
                                    <img src='./images/icons8-trash-32.png' alt='Eliminar'>
                                </button>
                            </form>
                        </td>
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
