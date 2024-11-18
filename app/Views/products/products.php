<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos</title>
  <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/styles.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/css/products.css') ?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-4 mb-6">

    <!-- Filtros, búsqueda y botón de administración -->
    <div class="row mb-7 align-items-center">
      <div class="col-md-3">
        <select id="product-type" class="form-select">
          <option value="all">Todos</option>
          <option value="mate">Mates</option>
          <option value="bombilla">Bombillas</option>
        </select>
      </div>
      <div class="col-md-3">
        <select id="sort-price" class="form-select">
          <option value="default">Ordenar por precio</option>
          <option value="asc">Ascendente</option>
          <option value="desc">Descendente</option>
        </select>
      </div>
      <div class="col-md-4">
        <input type="text" id="product-search" class="form-control" placeholder="Buscar por nombre">
      </div>
      <div class="col-md-2 text-end">
        <a href="<?= base_url('/admin/products'); ?>" class="btn btn-primary">
          <i class="fas fa-cogs"></i> ADMINISTRAR
        </a>
      </div>
    </div>

    <!-- Lista de productos -->
    <div class="row mt-5" id="product-list"></div>

    <!-- Paginación -->
    <nav>
      <ul class="pagination justify-content-center" id="pagination"></ul>
    </nav>
  </div>

  <!-- Datos de productos en JSON -->
  <script>
    const allProducts = <?= json_encode($products); ?>;
  </script>

  <!-- JS de Bootstrap y JQuery -->
  <script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('javascript/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('javascript/products.js'); ?>"></script>
</body>

</html>
