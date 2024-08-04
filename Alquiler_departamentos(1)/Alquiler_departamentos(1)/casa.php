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

// Hacer la consulta para obtener los datos
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
    <title>Casas Disponibles</title>
</head>

<body>
    <!-- Creamos un menú -->
    <div class="icon-bar">
        <a href="inicio.php"><i class="fa fa-home"></i></a>
    </div>
    <h2>Casas Disponibles</h2>
    <hr>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Alquilar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = mysqli_fetch_array($result)) {
                        $ID = $fila['ID'];
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila['ID']); ?></td>
                        <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
                        <td><?php echo htmlspecialchars($fila['ubicacion']); ?></td>
                        <td>
                            <?php if (!empty($fila['imagen'])) { ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($fila['imagen']); ?>" alt="Imagen de alquiler" style="max-width: 100px; height: auto;">
                            <?php } else { ?>
                                <p>No disponible</p>
                            <?php } ?>
                        </td>
                        <td><?php echo htmlspecialchars($fila['precio']); ?></td>
                        <td>
                            <form action="alquilar.php" method="post">
                                <input type="hidden" name="ID" value="<?php echo $fila['ID']; ?>">
                                <button type="submit" style="background: none; border: none; padding: 0; margin: 0; cursor: pointer;">
                                    <img src='./images/icons8-Edit-32.png' alt='Editar'>
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

<?php
// Cerrar la conexión
mysqli_close($conn);
?>

