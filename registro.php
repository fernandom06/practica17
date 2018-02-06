<?php

//control de si llegan los parametros
if (isset($_POST["login"])==false || isset($_POST["password"])==false || isset($_POST["nombre"])==false || isset($_POST["apellido1"])==false || isset($_POST["apellido2"])==false || isset($_POST["passwordc"])==false){
    header("location:index.php?error=1");
}else{

    //control de si los parametros minimos tienen contenido
    if ($_POST["login"]=='' || $_POST["password"]=='' || $_POST["apellido1"]=='' || $_POST["nombre"]=='' || $_POST["passwordc"]==''){
        header("location:index.php?error=2");
    }else{

        $login=$_POST["login"];
        //control de contraseña
        if($_POST["password"]==$_POST["passwordc"] && strlen($_POST["password"])>7){
            $password=sha1($_POST["password"]);
        }else{
            header('location:index.php?error=3');
        }
        $nombre=$_POST["nombre"];
        $apellido1=$_POST["apellido1"];
        //ver si se manda el segundo apellido
        if (!$_POST["apellido2"]==''){
            $apellido2=$_POST["apellido2"];
            $sql="INSERT INTO usuarios(nombre, apellido1, apellido2, login, password) VALUES ('$nombre','$apellido1','$apellido2','$login','$password')";
        }else{
            $sql="INSERT INTO usuarios(nombre, apellido1, login, password) VALUES ('$nombre','$apellido1','$login','$password')";
        }

        //conexion a la bbdd
        $mysqli=new mysqli('localhost','red_social','red_social','red_social');

        //controlamos si existe un error en la conexion con la base de datos
        if ($mysqli->connect_errno){
            $error=$mysqli->connect_errno;
            $mysqli->close();
            header('location:index.php?error='.$error);
        }

        //control de errores con la bbdd
        if(!($mysqli->query($sql))){
            $error=$mysqli->errno;
            $mysqli->close();
            header('location:index.php?error='.$error);
        }
        session_start();
        $_SESSION["login"]=$login;
        $_SESSION["id_usuario"]=$mysqli->insert_id;
        $mysqli->close();
        header('location:muro.php');
    }
}


?>