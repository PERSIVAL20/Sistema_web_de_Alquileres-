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

// Obtener los mensajes del usuario
$query = "SELECT * FROM mensajes ";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/listas.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Ver Mensajes</title>
</head>
<body>
    <h2>Mensajes Enviados</h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mensaje</th>
                <th>Fecha de Envío</th>
                <th>Respuesta del Administrador</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['mensaje']; ?></td>
                <td><?php echo $row['fecha_envio']; ?></td>
                <td><?php echo $row['respuesta'] ? $row['respuesta'] : 'Sin respuesta'; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="enviar.php">Enviar otro mensaje</a>
</body>
</html>

<?php
mysqli_close($conn);
?>
