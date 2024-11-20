<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <p>Estas logueado como <?=$_COOKIE['usnombre']?></p>
    <p>¿Estas seguro que quieres cerrar la sesion?</p>
    <form action="<?=base_url('cerrarsesion')?>" method="get">
        <input type="submit" value="Cerrar sesion">
    </form>
</body>
</html>