<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de inicio con objeto JSON</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<script src="app.js"></script>
    
        <header>
            <h1>Repaso PHP</h1>
        </header>
        <main>
            <section id="signin">
                <h2>Formulario de acceso</h2>
                <form action="signin.php" method="post">
                    <div class="input">
                        <label for="email">Email: </label>
                        <input type="text" name="email" id="email" autofocus/>
                    </div>
                    <div class="input">
                        <label for="password">Contraseña </label>
                        <input type="password" name="password" id="password" />
                    </div>
                    <div id="div_botones">
                        <button type="submit" class="botones">Acceder</button>
                        <button type="reset">Borrar</button>
                        <!-- V2 <button type="button" onclick="mostrarFormularioAlta()">Nuevo usuario</button> -->
                    </div>
                </form>
            </section>
<!--        VERSION 2
            <section id="signup">
                <h2>Por favor, introduzca sus datos</h2>
                COMENTADO <form id="signupForm" > COMENTADO
                <form action="php/signup.php" method="post" >
                    <fieldset class="form2">
                        <legend>Datos personales</legend>
                        <div>
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre"  autofocus />
                            <div id="error-nombre"></div>
                        </div>

                        <div>
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" name="apellidos" id="apellidos"  />
                            <div id="error-apellidos"></div>
                        </div>

                        <div>
                            <label for="password1">Contraseña elegida:</label>
                            <input type="password" name="password1" id="password1" />
                        </div>

                        <div>
                            <label for="password2">Confirme la contraseña:</label>
                            <input type="password" name="password2" id="password2"  />
                            <div id="error-password"></div>
                        </div>
                        
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="emailUp"  />
                        </div>
                    </fieldset>

                    <fieldset class="form2">
                        <legend>Datos de la compra</legend>
                        <div>
                            <label for="nif">NIF:</label><br>
                            <input type="text" name="nif" id="nif" />
                            <div id="error-nif"></div>
                        </div>

                        <div>
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" />
                            <div id="error-telefono"></div>
                        </div>

                        <div>
                            <label for="direccion">Dirección:</label>
                            <input type="text" name="direccion" id="direccion"  />
                            <div id="error-direccion"></div>
                        </div>

                        <div>
                            <label for="ciudad">Ciudad</label>
                            <input type="text" name="ciudad" id="ciudad" />
                            <div id="error-ciudad"></div>
                        </div>
                    </fieldset>
                    <div class="div_botones">
                        <button type="submit" class="button2">Enviar datos</button>
                        <button type="reset" class="button2">Borrar datos</button>
                        <button type="button" class="button2" onclick="volverInicio()">Cancelar</button>
                    </div>
                </form>
            </section> -->
        </main>

</body>
</html>