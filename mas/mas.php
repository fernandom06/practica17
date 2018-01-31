<?php
session_start();
$id_usuario=$_SESSION["id_usuario"];
if (isset($_POST["mensaje"])==false){
    header("location:../muro.php");
}else{
    if ($_POST["mensaje"]==''){
        header("location:../muro.php");
    }else{
        $mensaje=$_POST["mensaje"];
    }
}
//conexion a la bbdd
$mysqli=new mysqli('localhost','red_social','red_social','red_social');

//controlamos si existe un error en la conexion con la base de datos
if ($mysqli->connect_errno){
    $error=$mysqli->connect_errno;
    //header('location:index.php?error='.$error);
}

$sql="INSERT INTO mensajes(texto, id_usuario) VALUES ('$mensaje','$id_usuario')";

if(!($resultado=$mysqli->query($sql))){
    $error=$mysqli->errno;
    //header('location:muro.php?error='.$error);
}

header("location:../muro.php")


?>