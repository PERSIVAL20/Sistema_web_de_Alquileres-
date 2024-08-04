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

// Verificar si se envió el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Consulta SQL para obtener los datos del usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
    $result = mysqli_query($conn, $sql);

    // Verificar si se encontró un usuario
    if ($result && mysqli_num_rows($result) == 1) {
        // Obtener información del usuario
        $row = mysqli_fetch_assoc($result);
        
        // Iniciar sesión
        $_SESSION["loggedin"] = true;
        $_SESSION["usuario"] = $usuario;
        $_SESSION["nombre"] = $row["nombre"];
        $_SESSION["rol"] = $row["rol"]; // Guardar el rol en la sesión
        
        // Redirigir al usuario según el rol
        switch ($row["rol"]) {
            case "admin":
                header("Location: inicioAdmin.php");
                break;
            case "vendedor":
                    header("Location: inicioAlquiler.php");
                    break;
            default:
                header("Location: inicio.php");
                break;
        }
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
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
  <title>Login</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h2>Login</h2>
                    <?php if (isset($error)) { ?>
                        <p><?php echo $error; ?></p>
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
                    
                    <button type="submit">Iniciar sesión</button>
                    <div class="register">
                        <p>¿No tienes una cuenta? <a href="registro.php">Registrarme</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
