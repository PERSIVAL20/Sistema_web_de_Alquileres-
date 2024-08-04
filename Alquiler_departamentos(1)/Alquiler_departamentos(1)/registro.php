<?php
// Iniciar sesión
session_start();

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

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"]; // Hash de la contraseña
    $rol = $_POST["rol"]; // Obtener el rol seleccionado

    // Consulta SQL para insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (usuario, contrasena, rol) VALUES ('$usuario', '$contrasena', '$rol')";

    if (mysqli_query($conn, $sql)) {
        $success = "Cuenta creada exitosamente. Ahora puede iniciar sesión.";
    } else {
        $error = "Error al crear la cuenta: " . mysqli_error($conn);
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
  <title>Registro</title>
</head>
<body>

    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h2>Registro</h2>
                    <?php if (isset($error)) { ?>
                        <p><?php echo $error; ?></p>
                    <?php } ?>
                    <?php if (isset($success)) { ?>
                        <p><?php echo $success; ?></p>
                    <?php } ?>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" id="usuario" name="usuario" required>
                        <label for="usuario">Usuario</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" id="contrasena" name="contrasena" required>
                        <label for="contrasena">Contraseña</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <select id="rol" name="rol" required>
                            <option value="usuario">Usuario</option>
                            <option value="vendedor">Vendedor</option>
                        </select>
                        <label for="rol">Rol</label>
                    </div>
                    <button type="submit">Registrar</button>
                    <div class="register">
                        <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
