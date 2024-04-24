<?php 
/*Llamar al connection (include/require)
include_once -> hace que se ejecute solo una vez al llevar el _once

al usar el include, tenemos acceso a todo el "SCOOPE" del archivo importado, como sus variables
*/


include_once "connection.php";
include_once "const.php";

// si hay mas de una linea de query necesitamos usar ; para indicar las diferentes querys
$select = "SELECT * FROM app ORDER BY 
            CASE WHEN estado = 'darkred' THEN 1
                 WHEN estado = 'orange' THEN 2
                 WHEN estado = 'darkblue' THEN 3
                 WHEN estado = 'darkgreen' THEN 4
                 ELSE 5 END,
            fecha ASC";


$select_prepare = $conn->prepare($select);
$select_prepare->execute();

//cursor 

// Hay dos tipos de petición de bdd fetch y fetchAll
//-fetch -> devuelve solo el primer registro que encuentre
//-fetchAll -> devuelve todos los registros que encuentre, devuelve un array

//El DPO devuelve un array asociativo
$resultado_select = $select_prepare->fetchAll();


if ($_POST){
    $estado = $_POST["estado"];
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    
    $insert = "INSERT INTO app (estado, titulo, estado_user, descripcion) VALUES (?,?,?,?)";
    //El prepare() y el execute() le dan seguridad a la app
    $insert_prepare = $conn->prepare($insert);
    $insert_prepare->execute([$estado, $titulo, $estados[$estado], $descripcion]);

    $insert_prepare = null;
    $conn = null;

    header("Location: index.php");
    // $insert_prepare->closeCursor();
}

if($_GET){
    $id = $_GET["id"];
    echo "ID es: ".$id;
}

// var_dump y print_r -> Nos muestra la información de la respuesta de este fetchAll()
// var_dump($resultado_select);
// print_r($resultado_select);

//Aquí ponemos las cosas que se ejecutaran al enviarse la pagina(como un constructor)
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
    <h1>TODO things</h1></header>
    <!-- Hay dos classes principales para el contenedor principales
    container
    container-fluid -> coje toda la pantalla en "xl" -->

    <main class="container">
        <div class="row">
            <section class="col-sm-6 section1">
                <?php foreach($resultado_select as $row) : ?>
                    <!-- Todo lo que pongamos aquí se ira renderizando dentro del foreach -->
                    <div style="color: white; background-color: <?= $row["estado"] ?>" class="row alert" alert role="alert">                    
                        <div class="wline col-sm-9"><?= $row["titulo"].": ".$row["descripcion"] ?></div>
                        <div class="wline text-end gx-5 gap-3 col-sm-3">
                            <!-- Hay que ver quetal va esto -->
                            <a href="index.php?id=<?= $row["id"] ?>&titulo=<?= $row["titulo"] ?>&descripcion=<?= $row["descripcion"] ?>&estado=<?= $row["estado"] ?>">✏️</a>
                            <a href="delete.php?id=<?= $row["id"] ?>">🗑️</a></div>
                    </div>
                <?php endforeach ?>
            </section>
            <section class="col-sm-6 section2">
                <!-- Hay que añadir la descripcion de la tarea -->
                <?php if($_GET) : ?>
                    <fieldset>
                        <legend>Edita tu tarea</legend>
                        <form method="GET" action="update.php">
                        <!-- El atributo name es lo que se asociara al valor -->
                        <input type="hidden" name="id" value=<?= $row["id"] ?> >
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" name="titulo" class="form-control" id="titulo" aria-describedby="tituloHelp" value="<?= $_GET["titulo"]  ?>" >
                            <div id="tituloHelp" class="form-text">Titulo de tu tarea.</div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" name="descripcion" class="form-control" id="descripcion" aria-describedby="descripcionHelp" value="<?= $_GET["descripcion"]  ?>" >
                            <div id="descripcionHelp" class="form-text">Descripción de hasta 250 caracteres.</div>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado">                                
                                <option value="darkred" <?php if($_GET["estado"] == "darkred") echo "selected" ?> > Urgente</option>
                                <option value="darkblue" <?php if($_GET["estado"] == "darkblue") echo "selected" ?>>Ejecutando</option>
                                <option value="orange" <?php if($_GET["estado"] == "orange") echo "selected" ?>>Pendiente</option>
                                <option value="darkgreen" <?php if($_GET["estado"] == "darkgreen") echo "selected" ?>>Finalizado</option>                                
                            </select>
                        </div>
                        <div class="row gap-4">
                        <button type="submit" class="btn col btn-primary">Enviar</button>
                        <button type="reset" class="btn col btn-danger">Limpiar</button>

                        </div>
                        <div class="my-3"><a href="index.php">Volver</a></div> 
                    </form>
                    </fieldset>
                    
                <?php endif ?>
                <?php if(!$_GET) : ?>
                    <fieldset>
                        <legend>Publica tu tarea</legend>
                        <form method="POST">
                        <!-- El atributo name es lo que se asociara al valor -->
                       
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" name="titulo" class="form-control" id="titulo" aria-describedby="tituloHelp" >
                            <div id="tituloHelp" class="form-text">Titulo de tu tarea.</div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" name="descripcion" class="form-control" id="descripcion" aria-describedby="descripcionHelp">
                            <div id="descripcionHelp" class="form-text">Descripción de hasta 250 caracteres.</div>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado">
                                <option value="darkred">Urgente</option>
                                <option value="orange" selected>Pendiente</option>
                                <option value="darkblue">Ejecutando</option>                                
                                <option value="darkgreen">Finalizado</option>
                            </select>
                        </div>
                        <div class="row gap-4">
                        <button type="submit" class="btn col btn-primary">Enviar</button>
                        <button type="reset" class="btn col btn-danger">Limpiar</button>

                        </div> 
                    </form>
                    </fieldset>
                    
                <?php endif ?>
            </section>
        </div>
    </main>

</body>
</html>