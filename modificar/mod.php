<?php
if (isset($_POST["id"])==false || isset($_POST["mensaje"])==false){
    header("location:../muro.php?error=1");
}else{
    if ($_POST["mensaje"]=='' || $_POST["id"]==''){
        header("location:../muro.php?error=1");
    }else{
        $id=$_POST["id"];
        $mensaje=$_POST["mensaje"];
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

$sql="UPDATE mensajes SET texto='$mensaje' WHERE id_mensaje='$id'";

if(!($resultado=$mysqli->query($sql))){
    $error=$mysqli->errno;
    $resultado->close();
    $mysqli->close();
    header('location:../muro.php?error='.$error);
}
$resultado->close();
$mysqli->close();
header('location:../muro.php');
?>