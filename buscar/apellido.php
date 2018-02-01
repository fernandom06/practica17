<?php
session_start();
if (isset($_GET["apellido"])==false){
    header("location:../muro.php?error=1");
}else{
    if ($_GET["apellido"]==''){
        header("location:../muro.php?error=1");
    }else{
        $apellido=$_GET["apellido"];
    }
}
//conexion a la bbdd
$mysqli=new mysqli('localhost','red_social','red_social','red_social');

//controlamos si existe un error en la conexion con la base de datos
if ($mysqli->connect_errno){
    $error=$mysqli->connect_errno;
    header('location:../muro.php?error='.$error);
}

$sql="SELECT nombre,apellido1,login,id_usuario FROM usuarios WHERE apellido1 LIKE '%$apellido%'";

if(!($resultado=$mysqli->query($sql))){
    $error=$mysqli->errno;
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
    <title>Document</title>
</head>
<body>
<header><h1>Resultados</h1></header>
<main>
    <?php

    $fila=$resultado->fetch_assoc();
    while ($fila){
        echo "<a href='../muro/otro.php?id=".$fila['id_usuario']."'>".$fila['nombre']." ".$fila['apellido1']." (".$fila['login'].")</a><br>";
        $fila=$resultado->fetch_assoc();
    }
    ?>
</main>
</body>
</html>