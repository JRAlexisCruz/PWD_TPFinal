<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('/css/styles.css') ?>">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Logout</title>
</head>
<body>
<?= view('estructura/header'); ?>
</br>

<main class="d-flex flex-column justify-content-center align-items-center" >
<div class="d-flex flex-column align-items-center form-container py-4" style="width: 100%; max-width: 400px; margin: 0 auto; height: auto;">
    <p class="mt-1 align-self-center "><strong> Estas logueado como <?=$_COOKIE['usnombre']?></p> </strong>
    <p class="mt-1 align-self-center">¿Estas seguro que quieres cerrar la sesion?</p>
    <form action="<?=base_url('cerrarsesion')?>" method="get">
        <input type="submit" class="btn btn-primary mt-3" id="submit"   value="Cerrar sesion">
    </form>
</div>
    </main>
</br>
    <?= view('estructura/footer'); ?>
</body>
</html>