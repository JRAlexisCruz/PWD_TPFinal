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
        <?php foreach($menus as $menu): ?>
        <div class="card m-3" style="width: 18rem; height: 25rem;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <h5 class="card-title" style="font-size: 4rem;"><strong><i class="fa-solid fa-circle-user"></i></strong>
                </h5>
                <p class="card-text" style="font-size: 2rem;"><?=$menu['menombre']?></p>
                <p class="card-text" style="font-size: 1.2rem;"><?=$menu['medescripcion']?></p>
                <a href="<?=base_url($menu['script'])?>" class="btn btn-primary mt-auto" style="font-size: 2rem;">Ver</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?= view('estructura/footer'); ?>
    <script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('javascript/jquery.min.js'); ?>"></script>
</body>
</html>
