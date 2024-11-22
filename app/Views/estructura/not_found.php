<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/styles.css') ?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Not found</title>
</head>
<body>
<?=view('estructura/header')?>
    <main class="text-center py-5">
        <div class="container">
            <h1 class="mb-4">Error 404</h1>
            <p>Lo sentimos, la página que buscas no existe.</p>
            <a href="index.php" class="btn btn-lg" style="background-color: var(--color-acento); color: white;">Volver al Inicio</a>
        </div>
    </main>
    <?=view('estructura/footer')?>
</body>
</html>
