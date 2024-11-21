<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url('css/styles.css')?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Registro</title>
</head>
<body class="d-flex flex-column align-items-center">
<main class="d-flex flex-column">
    <form action="<?=base_url('registro')?>" id="registro" class="mt-3" method="post">
        <div class="text-center mb-4">
            <h1 style="width:100%">Registro</h1>
        </div>
        <div class="input-group mt-3">
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
            <input type="text" class="form-control" placeholder="Nombre de usuario" aria-label="Username"  name="usnombre" id="usnombre">
        </div>
        <div id="error-usnombre" class="mb-3">

        </div>
        <div class="input-group mt-3">
            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
            <input type="text" class="form-control" placeholder="Contraseña" aria-label="Password"  name="uspass" id="uspass">
        </div>
        <div id="error-uspass">

        </div>
        <div class="input-group mt-3">
            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
            <input type="email" class="form-control" placeholder="Email" aria-label="Email"  name="usmail" id="usmail">
        </div>
        <div id="error-usmail">

        </div>
        <button type="submit" class="btn btn-primary mt-3" id="submit" style="width:100%">Registrarme</button>
    </form>
    <p class="mt-1 align-self-center">Ya tiene una cuenta? Ir a <a href="<?=base_url('login')?>">Iniciar sesión</a></p>
</main>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
<script src="<?=base_url('javascript/funciones.js')?>"></script>
<script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>

