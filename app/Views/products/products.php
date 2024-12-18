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
  <?= view('estructura/header'); ?>
  <div class="container mt-4 mb-6">

    <!-- Filtros, búsqueda y botón de administración -->
    <div class="row mb-7 align-items-center justify-content-center">
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
    </div>

    <!-- Lista de productos -->
    <div class="row mt-5" id="product-list"></div>

    <!-- Paginación -->
    <nav>
      <ul class="pagination justify-content-center" id="pagination"></ul>
    </nav>
  </div>

  

 <!-- Modal de Mensajes -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Notificación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="messageModalBody">
        <!-- El mensaje será dinámico -->
      </div>
    </div>
  </div>
</div>



  <?= view('estructura/footer'); ?>

  <!-- Datos de productos en JSON -->
  <script>
    const allProducts = <?= json_encode($products); ?>;
    console.log(allProducts); // Verifica que la variable `allProducts` contiene los productos de tipo "bombilla"
    console.log(type, product.tipoproducto);
  </script>

  <!-- JS de Bootstrap y JQuery -->
  <script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('javascript/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('javascript/products.js'); ?>"></script>
</body>

</html>