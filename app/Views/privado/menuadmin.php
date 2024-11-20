<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('/css/styles.css') ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Menu Administración</title>
</head>

<body>
    <?= view('estructura/header'); ?>
    <div class="d-flex justify-content-center align-items-center flex-wrap" style="min-height: 80vh;">
        <!-- Admin Usuario -->
        <div class="card m-3" style="width: 18rem; height: 18rem;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <h5 class="card-title" style="font-size: 4rem;"><strong><i class="fa-solid fa-circle-user"></i></strong>
                </h5>
                <p class="card-text" style="font-size: 2rem;">Admin Usuario</p>
                <a href="<?=base_url('admin/usuarios')?>" class="btn btn-primary mt-auto" style="font-size: 2rem;">Ver</a>
            </div>
        </div>
        <!-- Admin Productos -->
        <div class="card m-3" style="width: 18rem; height: 18rem;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <h5 class="card-title" style="font-size: 4rem;"><strong><i class="fa-solid fa-dolly"></i></strong></h5>
                <p class="card-text" style="font-size: 2rem;">Admin Producto</p>
                <a href="<?=base_url('admin/productos')?>" class="btn btn-primary mt-auto" style="font-size: 2rem;">Ver</a>
            </div>
        </div>
        <!-- Admin -->
        <div class="card m-3" style="width: 18rem; height: 18rem;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <h5 class="card-title" style="font-size: 4rem;"><strong><i class="fa-solid fa-gear"></i></strong></h5>
                <p class="card-text" style="font-size: 2rem;">Admin</p>
                <a href="<?=base_url('admin/roles')?>" class="btn btn-primary mt-auto" style="font-size: 2rem;">Ver</a>
            </div>
        </div>
    </div>
    <?= view('estructura/footer'); ?>
    <script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('javascript/jquery.min.js'); ?>"></script>
</body>
</html>