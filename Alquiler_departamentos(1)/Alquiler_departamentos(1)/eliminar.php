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

$ID = $_POST['ID'];

$sql = "DELETE FROM registros WHERE ID = '$ID'";

if (mysqli_query($conn, $sql)) {
    echo '<script language="javascript">';
    echo 'alert("Registro eliminado exitosamente.");';
    echo 'window.location="resultado.php";';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("Error al eliminar el registro.");';
    echo 'window.location="resultados.php";';
    echo '</script>';
}
?>
