<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título de la página -->
    <title>Página de inicio con objeto JSON</title>
    <!-- Enlace a la hoja de estilos CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Carga el script JavaScript "app.js" -->
    <script src="app.js"></script>
    
    <!-- Encabezado de la página -->
    <header>
        <h1>Identificación del cliente</h1>
    </header>
    
    <!-- Contenido principal de la página -->
    <main>
        <!-- Sección de inicio de sesión -->
        <fieldset id="signin">
            <legend>Identificación</legend>
            <!-- Formulario de inicio de sesión -->
            <form action="signin.php" method="post">
                <!-- Campo de entrada para el email -->
                <div class="input">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" autofocus/>
                </div>
                <!-- Campo de entrada para la contraseña -->
                <div class="input">
                    <label for="password">Contraseña: </label>
                    <input type="password" name="password" id="password" />
                </div>
                <!-- Sección de botones -->
                <div id="div_botones">
                    <!-- Botón de inicio de sesión -->
                    <button type="submit" class="botones">Iniciar sesión</button>
                    <!-- Botón de borrar datos -->
                    <button type="reset">Borrar datos</button>
                </div>
            </form>
        </fieldset>
        <?php
        session_start();
        if (isset($_SESSION['loginError']) && $_SESSION['loginError']) {
            echo "<p class='error'>Las credenciales ingresadas son incorrectas. Por favor, inténtalo de nuevo.</p>";
            unset($_SESSION['loginError']);
        }
        ?>
    </main>
</body>
</html>
