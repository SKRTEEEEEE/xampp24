<?php
error_reporting(0);

$ciudad = "Helsinki";
$ruta_icons = "https://www.imelcf.gob.pa/wp-content/plugins/location-weather/assets/images/icons/weather-icons/";
if($_POST){
    $ciudad = $_POST["ciudad"];
}


$URL = "https://api.openweathermap.org/data/2.5/weather?q=$ciudad&appid=89ffc096a5b90e75d38faaa8464ffc1e&units=metric&lang=es";

$stringMeteo = file_get_contents($URL); // devuelve un string


$jsonMeteo = json_decode($stringMeteo, true);


$nombre_icon = $jsonMeteo['weather']['0']['icon'];

/*
ciudad, weather -> description
main -> temp, temp_min, temp_max, feels_like, humidity
*/
?>

<!-- HTML  -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Meteo</title>
    <style>
        .icono{
            width: 30vw;
            height: 30vh;
        }
        .flex{
            display: flex;
            height: 20vh;
            width: 95vw;
            justify-content: space-evenly;
            align-items: center;
            
        }
        .flex-md-col{
            display: flex;
            height: 20vh;
            width: 95vw;
            justify-content: space-evenly;
            align-items: center;
            @media (max-width: 768px) {
                flex-direction: column;
                height: auto;
            }
        }
        div{
            display:block;
            @media (max-width: 768px) {
                display: flex;
                justify-content: space-between;
                width: 95vw;
            }
        }
        p{
            font-size: 1.5rem;
        }
        h1{
            font-size: 3rem;
        }
        main{
            background-color: #000000ec;
            color: white
        }
        body{
            
            height: 90vh;
            justify-content: center;
            align-content: center;
        }
        .details-box{
            display: flex;
            height: 20vh;
            width: 95vw;
            margin-top:24px;
            padding-left:24px;
            align-items: center;
            @media (max-width: 768px) {
                flex-direction: column;
                height: auto;
            }
        }



    </style>
</head>
<body style="<?php
    if ($jsonMeteo["main"]["temp"] > 28) {
        echo 'background-color: orange;';

    } elseif ($jsonMeteo["main"]["temp"] > 16) {
        echo 'background-color: green;';
    } elseif ($jsonMeteo["main"]["temp"] > -16) {
        echo 'background-color: blue;';
        
    } elseif($jsonMeteo["main"]["temp"]< -16) {
        echo 'background-color: white;';
    }
?>">
<main >

        <section class="flex">
        <form  method="post">
            <p id="ciudadHelp" >De que ciudad quieres saber el tiempo?</p>
    <label for="ciudad">Ciudad</label>
    <input autofocus type="text" name="ciudad" id="ciudad" aria-describedby="ciudadHelp" value='<?= $ciudad ?>'></form></section>
    <?php if(isset($jsonMeteo["name"]) ) : ?>
    <article>
        <section class="flex">
            <div>
        <h1>El tiempo de: <?= $ciudad ?> hoy</h1>
        <p><i><?= $jsonMeteo["weather"][0]["description"] ?></i></p></div>
        <img class="icono" src="<?= $ruta_icons.$nombre_icon ?>.svg" alt="icono del tiempo">
        <div>
                <h2>Temperatura 🌡️</h2>
                <p><?= $jsonMeteo["main"]["temp"] ?> ºC</p>
            </div>
        
    
    
    </section>
    <section class="details-box">
        
            
            <details>
            <summary class="details">Ver detalles del tiempo</summary>
            <section class="flex-md-col">
            <div>
                <h2>Temperatura minima ➖</h2>
                <p><?= $jsonMeteo["main"]["temp_min"] ?> ºC</p>
            </div>
            <div>
                <h2>Temperatura maxima ➕</h2>
                <p><?= $jsonMeteo["main"]["temp_max"] ?> ºC</p>
            </div>
            <div>
                <h2>Sensación térmica 🥶</h2>
                <p><?= $jsonMeteo["main"]["feels_like"] ?> ºC</p>
            </div>
            <div>
                <h2>Humedad 💧</h2>
                <p><?= $jsonMeteo["main"]["humidity"] ?> %</p>
            </div></section>
            </details></section>
    
    </article>
    <?php else :?>
        <p>Ciudad incorrecta</p>
       
    <?php endif; ?>
    </main>
  

</body>
</html>