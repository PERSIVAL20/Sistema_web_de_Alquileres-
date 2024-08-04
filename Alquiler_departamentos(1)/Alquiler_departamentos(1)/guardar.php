<?php
// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir archivo de configuración de la base de datos
    require_once('config.php');
  
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

    // Obtener los datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $cedula = $_POST['cedula'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_finalizacion = $_POST['fecha_finalizacion'];

    // Preparar la consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO registros (nombres, apellidos, cedula, email, telefono, fecha_inicio, fecha_finalizacion) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
        // Vincular los parámetros de la consulta
        mysqli_stmt_bind_param($stmt, "sssssss", $nombres, $apellidos, $cedula, $email, $telefono, $fecha_inicio, $fecha_finalizacion);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            echo '<script language="javascript">';
            echo 'alert("Guardado exitosamente");';
            echo 'window.location="resultado.php";'; // Redirige a una página de listado o éxito
            echo '</script>';
        } else {
            echo "Error al ejecutar la consulta: " . mysqli_error($conn);
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>
