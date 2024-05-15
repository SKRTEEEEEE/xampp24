<?php

// Ruta del archivo JSON con los datos de los empleados
$jsonFilePath = 'customers.json';

// Lee el contenido del archivo JSON
$jsonData = file_get_contents($jsonFilePath);

// Decodifica el JSON en un array asociativo
$empleados = json_decode($jsonData, true);

// Obtiene el email y la contraseña del usuario a partir del formulario
$user = $_POST["email"];
$pass = $_POST["password"];

// Variable para indicar si se encontró al usuario
$encontrado = false;

// Función para calcular la edad de una persona a partir de su fecha de nacimiento
function calcularEdad($fecha)
{
    // Crea un objeto DateTime con la fecha de nacimiento
    $fecha_nacimiento = new DateTime($fecha);

    // Crea un objeto DateTime con la fecha actual
    $hoy = new DateTime();

    // Calcula la diferencia entre las dos fechas en años
    $edad = $hoy->diff($fecha_nacimiento);
    return $edad->y;
}

// Recorre el array de empleados
foreach ($empleados as $empleado) {
    // Comprueba si el email y la contraseña del usuario coinciden con los del empleado
    if ($empleado['email'] == $user && $empleado['key'] == $pass) {
        // Imprime el código HTML de la página de bienvenida
        echo
            "<!DOCTYPE html>
            <html>
            <head>
                <title>Bienvenido " . $empleado["name"] . "</title>
                <link rel='stylesheet' href='css/style.css'>
            </head>
            <body>
            <main>
                <!-- Muestra la imagen del empleado, pasando su nombre y apellido a minúsculas -->
                <img src='img_customers/" . strtolower($empleado['name']) . "." . strtolower($empleado['surname']) . ".png' alt='Logo'>
                <div>
                <h1>Datos del cliente</h1>
                <p>Nombre: " . $empleado['name'] . "</p>
                <p>Apellido: " . $empleado["surname"] . "</p>
                <p>Edad: " . calcularEdad($empleado["dateBirth"]) . " años.</p>
                <p>Email: " . $empleado["email"] . "</p>
                </div>
            </main>
            </body>
            </html>";
        
        // Marca que se encontró al usuario
        $encontrado = true;
        // Sale del bucle for each
        break;
    } 
    
}
// Si no se encontró al usuario, redirige a la página de inicio
if (!$encontrado) {
    session_start();
    $_SESSION['loginError'] = true;
    header('Location: index.php');
    exit(); // para que no siga ejecutando el resto del código (por si hay algún error)
}
