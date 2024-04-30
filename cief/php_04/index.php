<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ECommerce</title>
    <link rel="stylesheet" href="css/style.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lugrasimo&display=swap');
    </style>
</head>

<body>
    <div class="contenedor">
        <header>
            <h1 class="rainbow-text">Tutti Frutti</h1>
        </header>
        <main>
            <section id="signin">
                <h2>Formulario de acceso</h2>
                <form action="php/signin.php" method="post">
                    <div>
                        <label for="email">Email: </label>
                        <input type="text" name="email" id="email" autofocus/>
                    </div>
                    <div>
                        <label for="password">Contraseña </label>
                        <input type="password" name="password" id="password" />
                    </div>
                    <div class="div_botones">
                        <button type="submit" class="botones">Acceder</button>
                        <button type="reset">Borrar</button>
                        <button type="button" onclick="mostrarFormularioAlta()">Nuevo usuario</button>
                    </div>
                </form>
            </section>

            <section id="signup">
                <h2>Por favor, introduzca sus datos</h2>
                <!-- id="signupForm" -->
                <form action="php/signup.php" method="post" >
                    <fieldset class="form2">
                        <legend>Datos personales</legend>
                        <div>
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" required min="2" max="20" autofocus />
                        </div>

                        <div>
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" name="apellidos" id="apellidos" required min="2" max="50" />
                        </div>

                        <div>
                            <label for="password1">Contraseña elegida:</label>
                            <input type="password" name="password1" id="password1" required min="8" max="20" />
                        </div>

                        <div>
                            <label for="password2">Confirme la contraseña:</label>
                            <input type="password" name="password2" id="password2" required min="8" max="20" />
                        </div>
                        <div id="errorPassword"></div>
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" required />
                        </div>
                    </fieldset>

                    <fieldset class="form2">
                        <legend>Datos de la compra</legend>
                        <div>
                            <label for="nif">NIF:</label><br>
                            <input type="text" name="nif" id="nif" required min="9" max="9" />
                        </div>

                        <div>
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" required min="9" max="9" />
                        </div>

                        <div>
                            <label for="direccion">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" required />
                        </div>

                        <div>
                            <label for="ciudad">Ciudad</label>
                            <input type="text" name="ciudad" id="ciudad" min="2" max="20" />
                        </div>
                    </fieldset>
                    <div class="div_botones">
                        <button type="submit" class="button2">Enviar datos</button>
                        <button type="reset" class="button2">Borrar datos</button>
                        <button type="button" class="button2" onclick="volverInicio()">Cancelar</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
    <script src="js/app.js"></script>
</body>

</html>