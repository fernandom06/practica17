<?php
if (isset($_GET["id"])==false){
    header("location:../muro.php=error=1");
}else{
    if($_GET["id"]==''){
        header("location:../muro.php=error=1");
    }else{
        $id=substr($_GET["id"],1);

    }
}

//conexion a la bbdd
$mysqli=new mysqli('localhost','red_social','red_social','red_social');

//controlamos si existe un error en la conexion con la base de datos
if ($mysqli->connect_errno){
    $error=$mysqli->connect_errno;
    header('location:index.php?error='.$error);
}

$sql="SELECT texto FROM mensajes WHERE id_mensaje='$id'";

if(!($resultado=$mysqli->query($sql))){
    $error=$mysqli->errno;
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
</head>
<body>
<h1>Escriba un nuevo mensaje para su muro</h1>
<form action="mod.php" method="post">
    <textarea name="mensaje" id="mensaje" cols="30" rows="10"><?=$fila['texto']?></textarea><br>
    <input type="number" value="<?=$id?>" name="id" hidden>
    <button>Modificar Mensaje</button>
</form>
<button>Atrás</button>
</body>
</html>