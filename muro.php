<?php
session_start();
if (isset($_SESSION["id_usuario"])==false) header("location:index.php");
$id_usuario=$_SESSION["id_usuario"];
if (isset($_GET["error"])) $error=$_GET["error"];

if (isset($_SESSION["login"])){
    $login=$_SESSION["login"];
}

//conexion a la bbdd
$mysqli=new mysqli('localhost','red_social','red_social','red_social');

//controlamos si existe un error en la conexion con la base de datos
if ($mysqli->connect_errno){
    $error=$mysqli->connect_errno;
    $mysqli->close();
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
    <title>Muro</title>
</head>
<body>
<header>
    <h1>Bienvenido a tu muro <?=$_SESSION["login"]?></h1>
    <button id="mas">Añadir mensaje</button>
    <button id="buscar">Buscar Usuarios</button>
    <button id="salir">Cerrar Sesion</button>
</header>
<main>
        <?php
        $sql="SELECT m.texto texto,m.id_mensaje id_mensaje, u.id_usuario id_usuario
                FROM mensajes m
                JOIN usuarios u USING (id_usuario)
                WHERE login='$login'";

        if(!($resultado=$mysqli->query($sql))){
            $error=$mysqli->errno;
            $resultado->close();
            $mysqli->close();
            header('location:index.php?error='.$error);
        }
        echo "<div id='mensajes'>";
        $fila=$resultado->fetch_assoc();
            while($fila){
                echo "<div id='".$fila['id_mensaje']."'>";
                    echo "<p>".$fila['texto']."</p>";
                    echo "<button class='eliminar' id='e".$fila['id_mensaje']."'>Eliminar Mensaje</button>";
                    echo "<button class='modificar' id='m".$fila['id_mensaje']."'>Modificar Mensaje</button>";
                echo "</div>";
                $fila=$resultado->fetch_assoc();
            }
            $resultado->close();
            $mysqli->close();
        echo "</div>";
        ?>
</main>
<?php
if (isset($error)){
    echo "<div id='error'>";
    if ($error==2002 || $error==1045 || $error==1044) echo "<p>Problema con la base de datos</p>";
    elseif ($error==1136) echo "<p>Error al introducir los datos a la base de datos</p>";
    elseif ($error==1) echo "<p>Error con los datos</p>";
    elseif ($error==1064) echo "<p>Error de sintaxis</p>";
    else echo "<p>Error</p>";
    echo "</div>";
}
?>
<script src="js/jquery-3.2.1.min.js"></script>
<script>
    $(function () {
        $("#mas").on("click",function () {
            window.location.href="mas/mensaje.php";
        });
        $(".modificar").on("click",function () {
            var id=$(this).attr("id");
            window.location.href="modificar/modificar.php?id="+id;
        });
        $(".eliminar").on("click",function () {
            var id=$(this).attr("id");
            var eliminar=confirm("Estas seguro de eliminar el mensaje");
            if (eliminar==true) {
                console.log(eliminar);
                window.location.href = "eliminar/eliminar.php?id=" + id;
            }
        });
        $("#buscar").on("click",function () {
            window.location.href="buscar/buscar.html";
        });
        $("#salir").on("click",function () {
            window.location.href="salir.php";
        });
    })
</script>
</body>
</html>