<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
