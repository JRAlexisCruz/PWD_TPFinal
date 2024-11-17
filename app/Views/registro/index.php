<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
<main class="d-flex flex-column">
    <form action="<?=base_url('registro')?>" id="registro" class="mt-3" method="post">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-6">
                <h1>Registro</h1>
            </div>
        </div>
        <div class="row justify-content-center align-items-center mt-3">
            <div class="col-12">
                <label for="usnombre" class="form-label">Nombre de usuario</label>
                <input name="usnombre" id="usnombre" type="text" class="form-control md-6">
            </div>
        </div>
        <div class="row justify-content-center align-items-center mt-1">
            <div class="col-12">
                <label for="uspass" class="form-label">Contraseña</label>
                <input name="uspass" id="uspass" type="password" class="form-control">
            </div>
        </div>
        <div class="row justify-content-center align-items-center mt-1">
            <div class="col-12">
                <label for="usmail" class="form-label">Email</label>
                <input name="usmail" id="usmail" type="email" class="form-control">
            </div>
        </div>

        <?php if(session()->has('error')): ?>

        <div class="row justify-content-center align-items-center mt-3">
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <?= session('error') ?>
                </div>
            </div>
        </div>

        <?php endif; ?>

        <div class="row justify-content-center align-items-center mt-3">
            <input type="hidden" name="accion" value="registro">
            <button type="submit" class="btn btn-primary submitButton" id="submit">Registrarse</button>
        </div>
    </form>
    <p class="mt-1 align-self-center">Ya tiene una cuenta? Ir a <a href="<?=base_url('login')?>">logearse</a></p>
</main>
</body>
</html>