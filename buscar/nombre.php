<?php
session_start();
if (isset($_SESSION["id_usuario"])==false) header("location:../index.php");
if (isset($_GET["nombre"])==false){
    header("location:../muro.php?error=1");
}else{
    if ($_GET["nombre"]==''){
        header("location:../muro.php?error=1");
    }else{
        $nombre=$_GET["nombre"];
        $id_usuario=$_SESSION["id_usuario"];
    }
}

//conexion a la bbdd
$mysqli=new mysqli('localhost','red_social','red_social','red_social');

//controlamos si existe un error en la conexion con la base de datos
if ($mysqli->connect_errno){
    $error=$mysqli->connect_errno;
    $mysqli->close();
    header('location:../muro.php?error='.$error);
}

$sql="SELECT nombre,apellido1,login,id_usuario FROM usuarios WHERE nombre LIKE '%$nombre%'AND id_usuario!=$id_usuario";

if(!($resultado=$mysqli->query($sql))){
    $error=$mysqli->errno;
    $resultado->close();
    $mysqli->close();
    header('location:../muro.php?error='.$error);
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../estilos/bootstrap.css">
    <title>Busquedo por nombre</title>
</head>
<body>
<header class="jumbotron"><h1>Resultados</h1></header>
<main class="container">
    <?php

    $fila=$resultado->fetch_assoc();
    if ($fila) {
        while ($fila) {
            echo "<a href='../muro/otro.php?id=" . $fila['id_usuario'] . "'>" . $fila['nombre'] . " " . $fila['apellido1'] . " (" . $fila['login'] . ")</a><br>";
            $fila = $resultado->fetch_assoc();
        }
    }else{
        echo "<p>No se han encontrado resultados</p>";
    }
    $resultado->close();
    $mysqli->close();
    ?>
    <button id="atras" class="btn btn-light">Atras</button>
</main>
<script src="../js/jquery-3.2.1.min.js"></script>
<script>
    $(function () {
        $("#atras").on("click",function () {
            window.location.href = "buscar.html";
        });
    })
</script>
</body>
</html>