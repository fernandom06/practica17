<?php

if (isset($_POST["login"])==false || isset($_POST["password"])==false){
    header("location:index.php?error=4");
}else{
    $login=$_POST["login"];
    $password=sha1($_POST["password"]);

    //conexion a la bbdd
    $mysqli=new mysqli('localhost','red_social','red_social','red_social');

    //controlamos si existe un error en la conexion con la base de datos
    if ($mysqli->connect_errno){
        $error=$mysqli->connect_errno;
        header('location:index.php?error='.$error);
    }

    $sql="SELECT count(*) numero FROM usuarios WHERE login='$login' AND password='$password'";

    if(!($resultado=$mysqli->query($sql))){
        $error=$mysqli->errno;
        header('location:index.php?error='.$error);
    }

    $fila=$resultado->fetch_assoc();

    if ($fila["numero"]==1){
        header("location:muro.php");
    }
    else{
        header("location:index.php?error=5");
    }
}

?>