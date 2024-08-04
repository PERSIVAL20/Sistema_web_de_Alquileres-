<?php

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

// Verificar si se ha enviado el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $mensaje = mysqli_real_escape_string($conn, $_POST['mensaje']);

    // Insertar el mensaje en la base de datos
    $query = "INSERT INTO mensajes (mensaje) VALUES ('$mensaje')";

    if (mysqli_query($conn, $query)) {
        echo '<script language="javascript">';
            echo 'alert("Mensaje enviado con éxito");';
            echo 'window.location="comunicacion.php";'; // Redirige a la página donde el usuario puede ver sus mensajes
            echo '</script>';
    } else {
        echo "Error al enviar el mensaje: " . mysqli_error($conn);
    }
}

// Cerrar la conexión
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/listas.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Enviar Mensaje al Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Enviar Mensaje al Administrador</h2>
    <form action="enviar.php" method="post">
        <label for="mensaje">Mensaje:</label><br>
        <textarea id="mensaje" name="mensaje" rows="4" cols="50" required></textarea><br><br>
        <input type="submit" value="Enviar Mensaje">
    </form>
</body>
</html>
