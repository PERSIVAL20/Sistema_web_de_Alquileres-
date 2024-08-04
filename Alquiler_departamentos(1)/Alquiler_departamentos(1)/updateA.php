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

// Verificar si se ha enviado el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nombres = mysqli_real_escape_string($conn, $_POST['nombres']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $cedula = mysqli_real_escape_string($conn, $_POST['cedula']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $fecha_inicio = mysqli_real_escape_string($conn, $_POST['fecha_inicio']);
    $fecha_finalizacion = mysqli_real_escape_string($conn, $_POST['fecha_finalizacion']);

    // Actualizar los datos en la base de datos
    $query = "UPDATE registros SET nombres='$nombres', apellidos='$apellidos', cedula='$cedula', email='$email', telefono='$telefono', fecha_inicio='$fecha_inicio', fecha_finalizacion='$fecha_finalizacion' WHERE ID='$id'";

    if (mysqli_query($conn, $query)) {
        echo '<script language="javascript">';
        echo 'alert("Datos actualizados exitosamente.");';
        echo 'window.location="resultadoA.php";';
        echo '</script>';
    } else {
        echo "Error al actualizar los datos: " . mysqli_error($conn);
    }
} else {
    echo "No se ha enviado el formulario por el método POST.";
}

// Cerrar la conexión
mysqli_close($conn);
?>
