<?php
include("config.php");

$ID = $_POST['ID'];

$host = "localhost";
$usuario_bd = "Kimberly";
$contrasena_bd = "7idbd]JSpw(sT)jl";
$nombre_bd = "bd_prueba";

$conn = mysqli_connect($host, $usuario_bd, $contrasena_bd, $nombre_bd);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Realizar la consulta para obtener los datos del registro con ese ID
$query = "SELECT * FROM registros WHERE ID = '$ID'";
$result = mysqli_query($conn, $query);

// Verificar si se encontraron resultados
if (mysqli_num_rows($result) > 0) {
    // Obtener los datos del registro
    $row = mysqli_fetch_assoc($result);

    // Obtener la fecha actual y la fecha de inicio
    $fecha_actual = new DateTime();
    $fecha_inicio = new DateTime($row['fecha_inicio']);

    // Calcular la diferencia en días entre las fechas
    $diferencia_dias = $fecha_actual->diff($fecha_inicio)->days;

    // Verificar si la diferencia es menor a 3 días
    if ($diferencia_dias < 3) {
        echo '<script language="javascript">';
        echo 'alert("Comuníquese con el admin  solo se puede modificar hasta 3 dias antes de la fecha inicio ");';
        echo 'window.location="inicio.php";';
        echo '</script>';
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/plantilla.css">
    
</head>
<body>
    <h2>Editar Datos</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
        <label for="nombres">Nombres:</label><br>
        <input type="text" id="nombres" name="nombres" value="<?php echo $row['nombres']; ?>" required><br>
        <label for="apellidos">Apellidos:</label><br>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $row['apellidos']; ?>" required><br>
        <label for="cedula">Cédula:</label><br>
        <input type="text" id="cedula" name="cedula" value="<?php echo $row['cedula']; ?>" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" required><br>
        <label for="fecha_inicio">Fecha de Inicio:</label><br>
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $row['fecha_inicio']; ?>" required><br>
        <label for="fecha_finalizacion">Fecha de Finalización:</label><br>
        <input type="date" id="fecha_finalizacion" name="fecha_finalizacion" value="<?php echo $row['fecha_finalizacion']; ?>" required><br>
        </div>
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>

<?php
} else {
    echo "No se encontraron resultados para el ID proporcionado.";
}
?>
