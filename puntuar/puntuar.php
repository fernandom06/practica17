<?php
session_start();
if (isset($_SESSION["id_usuario"])==false) header("location:../index.php");
if (isset($_GET["id"])==false){
    header("location:../muro.php?error=1");
}else{
    if ($_GET["id"]==''){
        header("location:../muro.php?error=1");
    }else{
        $id=$_GET["id"];
    }
}

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../estilos/bootstrap.css">
</head>
<body>
<header class="jumbotron">
    <h1>Puntua el mensaje</h1>
</header>
<main class="container">
    <form action='punt.php'>
        <input type="number" name="id" value="<?=$id?>" hidden>
        <label for="1">1</label>
        <input type="radio" id="1" name="puntuacion" value="1"><br>
        <label for="2">2</label>
        <input type="radio" id="2" name="puntuacion" value="2"><br>
        <label for="3">3</label>
        <input type="radio" id="3" name="puntuacion" value="3"><br>
        <label for="4">4</label>
        <input type="radio" id="4" name="puntuacion" value="4"><br>
        <label for="5">5</label>
        <input type="radio" id="5" name="puntuacion" value="5"><br>
        <label for="6">6</label>
        <input type="radio" id="6" name="puntuacion" value="6"><br>
        <label for="7">7</label>
        <input type="radio" id="7" name="puntuacion" value="7"><br>
        <label for="8">8</label>
        <input type="radio" id="8" name="puntuacion" value="8"><br>
        <label for="9">9</label>
        <input type="radio" id="9" name="puntuacion" value="9"><br>
        <label for="10">10</label>
        <input type="radio" id="10" name="puntuacion" value="10"><br>
        <button class="btn btn-primary">Puntua el mensaje</button>
    </form>
</main>
</body>
</html>