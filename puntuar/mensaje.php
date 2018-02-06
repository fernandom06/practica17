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
        $id_usuario=$_SESSION["id_usuario"];
    }
}

//conexion a la bbdd
$mysqli=new mysqli('localhost','red_social','red_social','red_social');

//controlamos si existe un error en la conexion con la base de datos
if ($mysqli->connect_errno){
    $error=$mysqli->connect_errno;
    $mysqli->close();
    header("location:../muro.php?error=".$error);
}

$sql="SELECT texto,id_mensaje FROM mensajes WHERE id_mensaje=$id";

if(!($resultado=$mysqli->query($sql))){
    $error=$mysqli->errno;
    $resultado->close();
    $mysqli->close();
    header("location:../muro.php?error=".$error);
}

$sql_enlace="SELECT count(*) num FROM votos WHERE id_mensaje=$id AND id_usuario=$id_usuario";

if(!($resultado_enlace=$mysqli->query($sql_enlace))){
    $error=$mysqli->errno;
    $resultado->close();
    $mysqli->close();
    header("location:../muro.php?error=".$error);
}

$sql_puntuacion="SELECT puntuacion FROM votos WHERE id_mensaje=$id";

if(!($resultado_puntuacion=$mysqli->query($sql_puntuacion))){
    $error=$mysqli->errno;
    $resultado->close();
    $mysqli->close();
    header("location:../muro.php?error=".$error);
}
$puntuacion=0;
$contador=0;
while ($fila_puntuacion=$resultado_puntuacion->fetch_assoc()){
    $puntuacion+=$fila_puntuacion["puntuacion"];
    $contador++;
}

$puntuacion_media=0;
if ($contador>0) $puntuacion_media=$puntuacion/$contador;

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
    <h1>Detalles del mensaje</h1>
</header>
<main class="container">
<?php
if ($puntuacion_media==0) echo "<p>Este mensaje todavia no tiene votos</p>";
else echo "<p>La puntuacion media del mensaje es de: <strong>$puntuacion_media</strong></p>";
$fila=$resultado->fetch_assoc();
$enlace=$resultado_enlace->fetch_assoc();
if ($enlace["num"]==0) echo "<p><a href='puntuar.php?id=".$fila['id_mensaje']."'>Puntuar Mensaje</a></p>";
else echo "<p>Ya has puntuado en este mensaje</p>";
echo "<p><strong>Mensaje:</strong> ".$fila['texto']."</p>";
$resultado->close();
$mysqli->close();
?>
</main>
</body>
</html>