<?php
session_start();
if (isset($_GET["id"])==false || isset($_GET["puntuacion"])==false){
    header("location:../muro.php?error=1");
}else{
    if ($_GET["id"]=='' || $_GET["puntuacion"]==''){
        header("location:../muro.php?error=1");
    }else{
        $id=$_GET["id"];
        $puntuacion=$_GET["puntuacion"];
    }
}

$id_usuario=$_SESSION["id_usuario"];

//conexion a la bbdd
$mysqli=new mysqli('localhost','red_social','red_social','red_social');

//controlamos si existe un error en la conexion con la base de datos
if ($mysqli->connect_errno){
    $error=$mysqli->connect_errno;
    $mysqli->close();
    header("location:../muro.php?error=".$error);
}

$sql="INSERT INTO votos(puntuacion, id_mensaje, id_usuario) VALUES ($puntuacion,$id,$id_usuario)";

if(!($resultado=$mysqli->query($sql))){
    $error=$mysqli->errno;
    $resultado->close();
    $mysqli->close();
    header("location:../muro.php?error=".$error);
}
$resultado->close();
$mysqli->close();
header("location:mensaje.php?id=".$id);
?>