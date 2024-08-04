<?php
include("config.php");

// Configuración de conexión a la base de datos

$host = "localhost";
$usuario_bd = "Kimberly";
$contrasena_bd = "7idbd]JSpw(sT)jl";
$nombre_bd = "bd_prueba";
// Conectar a la base de datos
$conn = mysqli_connect($host, $usuario_bd, $contrasena_bd, $nombre_bd);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si se ha enviado el formulario para responder a un mensaje
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar_respuesta'])) {
    $ID = mysqli_real_escape_string($conn, $_POST['ID']);
    $respuesta = mysqli_real_escape_string($conn, $_POST['respuesta']);

    // Actualizar la respuesta en la base de datos
    $query = "UPDATE mensajes SET respuesta='$respuesta' WHERE ID='$ID'";

    if (mysqli_query($conn, $query)) {
        echo '<script language="javascript">';
            echo 'alert("Respuesta enviada con éxito");';
            echo 'window.location="visualizar.php";'; // Redirige a la misma página para ver los mensajes actualizados
            echo '</script>';
    } else {
        echo "Error al enviar la respuesta: " . mysqli_error($conn);
    }
}

// Obtener todos los mensajes para mostrar al administrador
$query = "SELECT * FROM mensajes";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/listas.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Mensajes del Administrador</title>
    
</head>
<body>
    <h2>Mensajes del Administrador</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mensaje</th>
                <th>Fecha de Envío</th>
                <th>Respuesta</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo htmlspecialchars($row['mensaje']); ?></td>
                <td><?php echo $row['fecha_envio']; ?></td>
                <td>
                    <?php echo $row['respuesta'] ? htmlspecialchars($row['respuesta']) : '<span class="no-response">Sin respuesta</span>'; ?>
                </td>
                <td>
                    <?php if (!$row['respuesta']) { // Mostrar el formulario solo si no hay respuesta ?>
                    <form action="visualizar.php" method="post">
                        <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                        <textarea name="respuesta" rows="4" cols="50" placeholder="Escriba su respuesta aquí..." required></textarea><br>
                        <input type="submit" name="enviar_respuesta" value="Enviar Respuesta">
                    </form>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="inicioAdmin.php">Volver a la página principal</a>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
