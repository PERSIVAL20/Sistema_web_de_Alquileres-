<?php
// Conexión a la base de datos

$host = "localhost";
$usuario_bd = "Kimberly";
$contrasena_bd = "7idbd]JSpw(sT)jl";
$nombre_bd = "bd_prueba";

$conn = mysqli_connect($host, $usuario_bd, $contrasena_bd, $nombre_bd);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Inicializar variables para mensajes de éxito o error
$success = $error = "";

// Verificar si se envió el formulario de subida
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $descripcion = $_POST["descripcion"];
    $ubicacion = $_POST["ubicacion"];
    $precio = $_POST["precio"];
    $estado = "A"; // Estado siempre será 'A'

    // Manejo del archivo de imagen
    $imagen = $_FILES["imagen"]["tmp_name"];
    $imagen_nombre = $_FILES["imagen"]["name"];
    $imagen_tipo = $_FILES["imagen"]["type"];
    $imagen_datos = addslashes(file_get_contents($imagen));

    // Consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO alquiler (imagen, descripcion, ubicacion, precio, estado) VALUES ('$imagen_datos', '$descripcion', '$ubicacion', '$precio', '$estado')";

    if (mysqli_query($conn, $sql)) {
        $success = "Imagen subida y datos guardados exitosamente.";
    } else {
        $error = "Error al guardar los datos: " . mysqli_error($conn);
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
  <link rel="stylesheet" href="css/index.css">
  <title>Subir Imagen</title>
</head>
<body>
<div class="icon-bar">
    <a href="inicioAlquiler.php"><i class="img"><img src="images/login1.jpeg" height="40" alt=""</i></a>

    </div>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <section>
    <div class="form-box">
      <div class="form-value">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
          <h2>Subir Imagen</h2>
          <?php if (!empty($error)) { ?>
            <p><?php echo $error; ?></p>
          <?php } ?>
          <?php if (!empty($success)) { ?>
            <p><?php echo $success; ?></p>
          <?php } ?>
          <div class="inputbox">
            <input type="file" id="imagen" name="imagen" required>
            <label for="imagen">Seleccionar Imagen</label>
          </div>
          <div class="inputbox">
            <input type="text" id="descripcion" name="descripcion" required>
            <label for="descripcion">Descripción</label>
          </div>
          <div class="inputbox">
            <input type="text" id="ubicacion" name="ubicacion" required>
            <label for="ubicacion">Ubicación</label>
          </div>
          <div class="inputbox">
            <input type="number" id="precio" name="precio" required>
            <label for="precio">Precio</label>
          </div>
          <button type="submit">Subir</button>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
