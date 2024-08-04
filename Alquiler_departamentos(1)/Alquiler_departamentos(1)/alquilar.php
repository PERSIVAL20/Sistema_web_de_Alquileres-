<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/plantilla.css"> <!-- Asegúrate de que el archivo CSS se llame correctamente -->
</head>
<title>Formulario de Alquiler</title>
<body>
    <div class="icon-bar">
    <a href="casa.php"><i class="img"><img src="images/login1.jpeg" height="40" alt=""</i></a>
    </div>
    
    <h2>Formulario de Alquiler</h2>
    <hr>

    <div class="container">
        <form action="guardar.php" method="post">
            <div class="inputbox">
                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" name="nombres" required>
            </div>
            <div class="inputbox">
               <label for="apellidos">Apellidos:</label> 
               <input type="text" id="apellidos" name="apellidos" required>  
            </div>
            <div class="inputbox">
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula" required>
            </div>
            <div class="inputbox">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="inputbox">
                <label for="telefono">Teléfonos:</label>
                <input type="text" id="telefono" name="telefono" required>
            </div>
            <div class="inputbox">
                <label for="fecha_inicio">Fecha de inicio:</label> 
                <input type="date" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="inputbox">
                <label for="fecha_finalizacion">Fecha de finalización:</label>
                <input type="date" id="fecha_finalizacion" name="fecha_finalizacion" required>
            </div>
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
