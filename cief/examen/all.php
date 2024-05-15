<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Lista de Usuarios</h1>
    </header>
    <main>
        <?php
        // Ruta del archivo JSON con los datos de los usuarios
        $jsonFilePath = 'customers.json';

        // Lee el contenido del archivo JSON
        $jsonData = file_get_contents($jsonFilePath);

        // Decodifica el JSON en un array asociativo
        $usuarios = json_decode($jsonData, true);

        // Verifica si hay usuarios
        if (!empty($usuarios)) {
            // Muestra la información de cada usuario
            echo '<table>';
            echo '<thead><tr><th>Foto</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Edad</th></tr></thead>';
            echo '<tbody>';
            foreach ($usuarios as $usuario) {
                 // Calcula la fecha de nacimiento en el formato deseado
                 $fechaNacimiento = new DateTime($usuario['dateBirth']);
                 $fechaNacimientoFormateada = $fechaNacimiento->format('d-m-Y');

                // Muestra los datos del usuario en una fila de la tabla
                echo '<tr>';
                echo "<td><img src='img_customers/" . strtolower($usuario['name']) . "." . strtolower($usuario['surname']) . ".png' alt='Logo'></td>";
                echo '<td>' . $usuario['name'] . '</td>';
                echo '<td>' . $usuario['surname'] . '</td>';
                echo '<td>' . $usuario['email'] . '</td>';
                echo '<td>' . $fechaNacimientoFormateada . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No se encontraron usuarios.</p>';
        }
        ?>
    </main>
</body>
</html>
