<?php
if (isset($_GET["id"])==false){
    //header();
}else{
    if ($_GET["id"]==''){
        //header();
    }else{
        $id=$_GET["id"];
    }
}

//conexion a la bbdd
$mysqli=new mysqli('localhost','red_social','red_social','red_social');

//controlamos si existe un error en la conexion con la base de datos
if ($mysqli->connect_errno){
    $error=$mysqli->connect_errno;
    header('location:../muro.php?error='.$error);
}

$sql="SELECT m.texto texto,m.id_mensaje id_mensaje, u.id_usuario id_usuario, u.login login
                FROM mensajes m
                JOIN usuarios u USING (id_usuario)
                WHERE id_usuario=$id";

if(!($resultado=$mysqli->query($sql))){
    $error=$mysqli->errno;
    header('location:../muro.php?error='.$error);
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
    <title>Document</title>
</head>
<body>
<header>
    <h1>Bienvenido a tu muro <?=$fila["login"]?></h1>
    <button id="muro">Volver a tu muro</button>
</header>
<?php
echo "<div id='mensajes'>";
while($fila){
    echo "<div>";
    echo "<p>".$fila['texto']."</p>";
    echo "<button class='detalle' id='".$fila['id_mensaje']."'>Detalles del mensaje</button>";
    echo "</div>";
    $fila=$resultado->fetch_assoc();
}
echo "</div>";
?>
<script src="../js/jquery-3.2.1.min.js"></script>
<script>
    $(function () {
        $(".detalle").on("click",function () {
            var id=$(this).attr("id");
            window.location.href="../puntuar/mensaje.php?id="+id;
        });
        $("#muro").on("click",function () {
            window.location.href="../muro.php";
        });
    })
</script>
</body>
</html>