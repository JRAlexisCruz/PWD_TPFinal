<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
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
<script src="../../../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>