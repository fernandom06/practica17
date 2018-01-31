<?php
session_start();

if (isset($_SESSION["login"])){
    $login=$_SESSION["login"];
}else{
    //header();
}

//conexion a la bbdd
$mysqli=new mysqli('localhost','red_social','red_social','red_social');

//controlamos si existe un error en la conexion con la base de datos
if ($mysqli->connect_errno){
    $error=$mysqli->connect_errno;
    header('location:index.php?error='.$error);
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
<header>
    <h1>Bienvenido a tu muro <?=$_SESSION["login"]?></h1>
    <button>Añadir mensaje</button>
    <div id="mensajes">
        <?php
        $sql="SELECT m.texto texto,m.id_mensaje id_mensaje
                FROM mensajes m
                JOIN usuarios u USING (id_usuario)
                WHERE login='$login'";

        if(!($resultado=$mysqli->query($sql))){
            $error=$mysqli->errno;
            //header('location:index.php?error='.$error);
        }
        echo "<div id='mensajes'>";
            while($fila=$resultado->fetch_assoc()){
                echo "<div id='".$fila['id_mensaje']."'>";
                    echo "<p>".$fila['texto']."</p>";
                    echo "<button class='eliminar' id='".$fila['id_mensaje']."'>Eliminar Mensaje</button>";
                    echo "<button class='modificar' id='".$fila['id_mensaje']."'>Modificar Mensaje</button>";
                echo "</div>";
            }
        echo "</div>";

        ?>
    </div>
</header>
</body>
</html>