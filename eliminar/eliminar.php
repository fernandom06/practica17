<?php
if (isset($_GET["id"])==false){
    header("location:../muro.php?error=1");
}else{
    if($_GET["id"]==''){
        header("location:../muro.php?error=1");
    }else{
        $id=substr($_GET["id"],1);

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

$sql="DELETE FROM mensajes WHERE id_mensaje='$id'";

if(!($resultado=$mysqli->query($sql))){
    $error=$mysqli->errno;
    $resultado->close();
    $mysqli->close();
    header('location:../muro.php?error='.$error);
}

$resultado->close();
$mysqli->close();
header('location:../muro.php')
?>