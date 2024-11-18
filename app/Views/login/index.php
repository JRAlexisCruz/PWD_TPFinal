<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Login</title>
</head>
<body class="d-flex flex-column align-items-center">
<main class="d-flex flex-column">
    <form action="<?=base_url('login')?>" id="login" class="mt-3" method="post">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-6">
                <h1>Login</h1>
            </div>
        </div>
        <div class="row justify-content-center align-items-center mt-3">
            <div class="col-12">
                <label for="usnombre" class="form-label">Nombre de usuario</label>
                <input name="usnombre" id="usnombre" type="text" class="form-control md-6" value="<?=set_value('usnombre')?>">
            </div>
        </div>
        <div class="row justify-content-center align-items-center mt-1">
            <div class="col-12">
                <label for="uspass" class="form-label">Contraseña</label>
                <input name="uspass" id="uspass" type="password" class="form-control">
            </div>
        </div>
        
        <div class="row justify-content-center align-items-center mt-3">
            <input type="hidden" name="accion" value="login">
            <button type="submit" class="btn btn-primary submitButton" id="submit">Login</button>
        </div>
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
</html>