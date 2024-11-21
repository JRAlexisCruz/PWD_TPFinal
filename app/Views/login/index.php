<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url('css/styles.css')?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Login</title>
</head>
<body class="d-flex flex-column align-items-center">
<main class="d-flex flex-column">
    <form action="<?=base_url('login')?>" id="login" class="mt-3" method="post">
        <div class="text-center mb-4">
            <h1 style="width:100%">Inicio de Sesion</h1>
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
        <button type="submit" class="btn btn-primary mt-3" id="submit" style="width:100%">Iniciar sesion</button>
    </form>
    <?php if(session()->getFlashdata()): ?>
        <div class="row justify-content-center align-items-center mt-3">
            <div class="col-6">
                <div class="alert alert-danger" role="alert">
                    <?=session('error')?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <p class="mt-1 align-self-center">No tiene una cuenta? Ir a <a href="<?=base_url('registro')?>">registrarse</a></p>
</main>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
<script src="<?=base_url('javascript/funciones.js')?>"></script>
<script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url('css/styles.css')?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Login</title>
</head>
<body>
<?= view('estructura/header'); ?>
 
<main class="d-flex flex-column justify-content-center aling-items-center " >
<div class="d-flex flex-column aling-items-center  form-container py-4 " style="  width: 100%; max-width: 400px;  margin: 0 auto; height: 55vh; ">
<form action="<?=base_url('login')?>" id="login" class="mt-3" method="post">
        <div class="text-center mb-4">
            <h1 style="width:100%">Inicio de Sesion</h1>
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
        <button type="submit" class="btn btn-primary mt-3" id="submit" style="width:100%">Iniciar sesion</button>
    </form>
    <?php if(session()->getFlashdata()): ?>
        <div class="row justify-content-center align-items-center mt-3">
            <div class="col-6">
                <div class="alert alert-danger" role="alert">
                    <?=session('error')?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <p class="mt-1 align-self-center">No tiene una cuenta? Ir a <a href="<?=base_url('registro')?>">registrarse</a></p>
    </div>
</main>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
<script src="<?=base_url('javascript/funciones.js')?>"></script>
<script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
<?= view('estructura/footer'); ?>
</body>
</html>