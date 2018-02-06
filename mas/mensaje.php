<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir Mensaje</title>
    <link rel="stylesheet" href="../estilos/bootstrap.css">
</head>
<body>
<header class="jumbotron">
<h1>Escriba un nuevo mensaje para su muro</h1>
</header>
<main class="container">
<form action="mas.php" method="post" class="form-group">
    <textarea name="mensaje" id="mensaje" cols="30" rows="10" placeholder="Escriba su mensaje" class="form-control"></textarea><br>
    <button class="btn btn-primary">Añadir Mensaje</button>
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