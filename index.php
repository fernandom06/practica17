<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #login{
            display: none;
        }
        #registro{
            display: none;
        }
    </style>
</head>
<body>
<header>
    <h1>Red Social</h1>
</header>
<main>
    <div id="botones">
        <button id="loginb">Login</button>
        <button id="registrob">Registro</button>
    </div>
    <div id="login">
        <form action="login.php" method="post">
            <label for="loginl">Login</label>
            <input type="text" id="loginl" name="login"><br>
            <label for="passwordl">Password</label>
            <input type="password" id="passwordl" name="password"><br>
            <button>Entrar</button>
        </form>
    </div>
    <div id="registro">
        <form action="registro.php" method="post">
            <label for="loginr">Login*</label>
            <input type="text" id="loginr" name="login"><br>
            <label for="passwordr">Password*</label>
            <input type="password" id="passwordr" name="password"><br>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre"><br>
            <label for="apelldio1">Primer Apellido*</label>
            <input type="text" id="apelldio1" name="apellido1"><br>
            <label for="apellido2">Segundo Apellido</label>
            <input type="text" id="apellido2" name="apellido2"><br>
            <button>Registrarse</button>
            <p>Los campos marcados con * son obligatorios</p>
        </form>
    </div>
</main>
<script src="js/jquery-3.2.1.min.js"></script>
<script>
    $(function () {
        $("#loginb").on("click",function () {
            $("#login").toggle();
        });
        $("#registrob").on("click",function () {
            $("#registro").toggle();
        })
    })
</script>
</body>
</html>