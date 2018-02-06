<?php
if (isset($_GET["error"])){
    $error=$_GET["error"];
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portada</title>
    <link rel="stylesheet" href="estilos/bootstrap.css">
</head>
<body>
<header class="jumbotron">
    <h1>Red Social</h1>
</header>
<main class="container">
    <div class="row">
        <div id="login" class="col-6">
            <h2>Login</h2>
            <form action="login.php" method="post" class="form-group">
                <label for="loginl">Login</label>
                <input type="text" id="loginl" name="login" class="form-control"><br>
                <label for="passwordl">Password</label>
                <input type="password" id="passwordl" name="password" class="form-control"><br>
                <button class="btn btn-primary">Entrar</button>
            </form>
        </div>
        <div id="registro" class="col-6">
            <h2>Registro</h2>
            <form action="registro.php" method="post" class="form-group">
                <label for="loginr">Login*</label>
                <input type="text" id="loginr" name="login" class="form-control"><br>
                <label for="passwordr">Password* (minimo 8 caracteres)</label>
                <input type="password" id="passwordr" name="password" class="form-control"><br>
                <label for="passwordc">Repite la contraseña</label>
                <input type="password" id="passwordc" name="passwordc" class="form-control"><br>
                <label for="nombre">Nombre*</label>
                <input type="text" id="nombre" name="nombre" class="form-control"><br>
                <label for="apelldio1">Primer Apellido*</label>
                <input type="text" id="apelldio1" name="apellido1" class="form-control"><br>
                <label for="apellido2">Segundo Apellido</label>
                <input type="text" id="apellido2" name="apellido2" class="form-control"><br>
                <button class="btn btn-primary">Registrarse</button>
                <p>Los campos marcados con * son obligatorios</p>
            </form>
        </div>
    </div>
    <?php
    //Capa para el error
    if (isset($error)){
        echo "<div id='error' class='alert alert-danger'>";
        if ($error==1 || $error==2 || $error==4) echo "<p>Faltan datos</p>";
        elseif ($error==3) echo "<p>La contraseña no cumple los requisitos o no coinciden</p>";
        elseif ($error==5) echo "<p>Usuario o contraseña incorrectos</p>";
        elseif ($error==2002 || $error==1045 || $error==1044) echo "<p>Problema con la base de datos</p>";
        elseif ($error==1062) echo "<p>El login ya esta en uso</p>";
        elseif ($error==1048 || $error==1364) echo "<p>Los datos estan mal introducidos</p>";
        elseif ($error==1064) echo "<p>Error al modificar</p>";
        else echo "<p>Error</p>";
        echo "</div>";
    }
    ?>
</main>
</body>
</html>