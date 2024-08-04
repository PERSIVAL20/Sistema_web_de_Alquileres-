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
        echo 'alert("Comuníquese con el admin. Solo se puede modificar hasta 3 días antes de la fecha de inicio.");';
        echo 'window.location="inicio.php";';
        echo '</script>';
        exit;
    } else {
        // Mostrar opciones para eliminar, modificar o regresar
        echo '<!DOCTYPE html>';
        echo '<html>';
        echo '<head>';
        echo '<title>Opciones</title>';
        echo '<link rel="stylesheet" href="css/plantilla.css">';
        echo '</head>';
        echo '<body>';
        echo '<div class="container">';
        echo '<h2>¿Qué desea hacer con este registro?</h2>';
        echo '<form method="post" action="eliminar.php">';
        echo '<input type="hidden" name="ID" value="' . $ID . '">';
        echo '<button type="submit">Eliminar</button>';
        echo '</form>';
        echo '<form method="post" action="edicion.php">';
        echo '<input type="hidden" name="ID" value="' . $ID . '">';
        echo '<button type="submit">Modificar</button>';
        echo '</form>';
        echo '<form method="post" action="inicio.php">';
        echo '<button type="submit">Regresar</button>';
        echo '</form>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
    }
} else {
    echo '<script language="javascript">';
    echo 'alert("Registro no encontrado.");';
    echo 'window.location="inicio.php";';
    echo '</script>';
}
?>
