<?php 
/*Llamar al connection (include/require)
include_once -> hace que se ejecute solo una vez al llevar el _once

al usar el include, tenemos acceso a todo el "SCOOPE" del archivo importado, como sus variables
*/


include_once "connection.php";
include_once "const.php";

// si hay mas de una linea de query necesitamos usar ; para indicar las diferentes querys
$select = "SELECT * FROM info_colores";
// 
$select_prepare = $conn->prepare($select);
$select_prepare->execute();

//cursor 

// Hay dos tipos de petición de bdd fetch y fetchAll
//-fetch -> devuelve solo el primer registro que encuentre
//-fetchAll -> devuelve todos los registros que encuentre, devuelve un array

//El DPO devuelve un array asociativo
$resultado_select = $select_prepare->fetchAll();


if ($_POST){
    $color = $_POST["color"];
    $usuario = $_POST["usuario"];
    
    $insert = "INSERT INTO info_colores (color, usuario, color_user) VALUES (?,?,?)";
    //El prepare() y el execute() le dan seguridad a la app
    $insert_prepare = $conn->prepare($insert);
    $insert_prepare->execute([$color, $usuario, $colores[$color]]);

    $insert_prepare = null;
    $conn = null;

    header("Location: index.php");
    // $insert_prepare->closeCursor();
}

if($_GET){
    $id = $_GET["id"];
    echo "ID es: ".$id;
    // $update = "UPDATE info_colores SET color = ? WHERE id = ?"; 
    // $delete_prepare = $conn->prepare($update);
    // $delete_prepare->execute([$id]);

    // $delete_prepare = null;
    // $conn = null;

    // header("Location: index.php");
}

// var_dump y print_r -> Nos muestra la información de la respuesta de este fetchAll()
// var_dump($resultado_select);
// print_r($resultado_select);

//forEach -> *al usarlo en DPO*
// foreach ($resultado_select as $key => $value){
//     echo $value["color"]. "<br>";
// }

//Aquí ponemos las cosas que se ejecutaran al enviarse la pagina(como un constructor)
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi primera app PHP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
    <h1>Hola mundo </h1></header>
    <!-- Hay dos classes principales para el contenedor principales
    container
    container-fluid -> coje toda la pantalla en "xl" -->

    <main class="container">
        <div class="row">
            <section class="col-sm-6 section1">
                <?php foreach($resultado_select as $row) : ?>
                    <!-- Todo lo que pongamos aquí se ira renderizando dentro del foreach -->
                    <div style="color: white; background-color: <?= $row["color"] ?>" class="row alert" alert role="alert">
                        <!-- <?php echo $row["usuario"].": ".$row["color"] ?> Esto equivale al siguiente código-->
                        
                        <div class="wline col-sm-9"><?= $row["usuario"].": ".$row["color_user"] ?></div>
                        <div class="wline text-end gx-5 gap-3 col-sm-3"><a href="index.php?id=<?= $row["id"] ?>&usuario=<?= $row["usuario"] ?>&color=<?= $row["color"] ?>">✏️</a><a href="delete.php?id=<?= $row["id"] ?>">🗑️</a></div>
                    </div>
                <?php endforeach ?>
            </section>
            <section class="col-sm-6 section2">
                <?php if($_GET) : ?>
                    <fieldset>
                        <legend>Edita tu datos</legend>
                        <form method="GET" action="update.php">
                        <!-- El atributo name es lo que se asociara al valor -->
                        <input type="hidden" name="id" value=<?= $row["id"] ?> >
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" name="usuario" class="form-control" id="usuario" aria-describedby="usuarioHelp" value="<?= $_GET["usuario"]  ?>" >
                            <div id="usuarioHelp" class="form-text">Usuario que va a guardar su color.</div>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <select name="color" id="color">
                                <option value="darkblue" <?php if($_GET["color"] == "darkblue") echo "selected" ?>>Azul</option>
                                <option value="darkred" <?php if($_GET["color"] == "darkred") echo "selected" ?> > Rojo</option>
                                <option value="darkgreen" <?php if($_GET["color"] == "darkgreen") echo "selected" ?>>Verde</option>
                                <option value="orange" <?php if($_GET["color"] == "orange") echo "selected" ?>>Naranja</option>
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
                        <legend>Publica tu color</legend>
                        <form method="POST">
                        <!-- El atributo name es lo que se asociara al valor -->
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" name="usuario" class="form-control" id="usuario" aria-describedby="usuarioHelp">
                            <div id="usuarioHelp" class="form-text">Usuario que va a guardar su color.</div>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <select name="color" id="color">
                                <option value="darkblue" selected>Azul</option>
                                <option value="darkred">Rojo</option>
                                <option value="darkgreen">Verde</option>
                                <option value="orange">Naranja</option>
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