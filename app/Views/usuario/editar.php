<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=base_url('css/bootstrap.min.css')?>" rel="stylesheet">
    <script type="text/javascript" src="<?=base_url('javascript/jquery.min.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Editar</title>
</head>
<body>
    <form action="<?=base_url('perfil/editar')?>" method="post" id="editar">
        <div class="mb-3">
            <label for="usnombre" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="usnombre" name="usnombre" value="<?=$usnombre?>">
        </div>
        <div id="error-usnombre">

        </div>
        <div class="mb-3">
            <label for="usmail" class="form-label">Email</label>
            <input type="text" class="form-control" id="usmail" name="usmail" value="<?=$usmail?>">
        </div>
        <div id="error-usmail">
            
        </div>
        <div class="mb-3">
            <label for="uspass" class="form-label">Contraseña</label>
            <input type="text" class="form-control" id="uspass" name="uspass">
        </div>
        <div id="error-uspass">
            
        </div>
        <button class="btn btn-primary" id="submit">Guardar</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="<?=base_url('javascript/funciones.js')?>"></script>
</body>
</html>