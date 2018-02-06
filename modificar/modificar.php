<?php
session_start();
if (isset($_SESSION["id_usuario"])==false) header("location:../index.php");
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

$sql="SELECT texto FROM mensajes WHERE id_mensaje='$id'";

if(!($resultado=$mysqli->query($sql))){
    $error=$mysqli->errno;
    $resultado->close();
    $mysqli->close();
    header('location:muro.php?error='.$error);
}

$fila=$resultado->fetch_assoc();

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Mensaje</title>
    <link rel="stylesheet" href="../estilos/bootstrap.css">
</head>
<body>
<header class="jumbotron">
    <h1>Escriba un nuevo mensaje para su muro</h1>
</header>
<main class="container">
    <form action="mod.php" method="post" class="form-group">
        <textarea name="mensaje" id="mensaje" cols="30" rows="10" class="form-control"><?=$fila['texto']?></textarea><br>
        <input type="number" value="<?=$id?>" name="id" hidden>
        <?php
        $resultado->close();
        $mysqli->close();
        ?>
        <button class="btn btn-primary">Modificar Mensaje</button>
    </form>
    <button id="atras" class="btn btn-light">Atrás</button>
</main>
<script src="../js/jquery-3.2.1.min.js"></script>
<script>
    $(function () {
        $("#atras").on("click",function () {
            window.location.href = "../muro.php";
        });
    })
</script>
</body>
</html>