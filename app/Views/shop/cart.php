<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito de Compras</title>
  <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/styles.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/css/cart.css') ?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

  <?= view('estructura/header'); ?>

  <div class="container mt-4">
    <h1 class="text-center mb-4">Carrito de Compras <i class="fa-solid fa-cart-shopping"></i></h1>

    <table class="table table-striped">
      <thead class="table">
        <tr>
          <th>Imagen</th>
          <th>Nombre del Producto</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Precio Total</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php if (!empty($cartItems)): ?>
          <?php foreach ($cartItems as $item): ?>
            <tr>
              <td class="text-center">
                <img src="<?= base_url('images/' . esc($item['proimagen'])) ?>.jpg"
                  alt="<?= esc($item['pronombre']) ?>" class="rounded-circle"
                  style="width: 80px; height: 80px; object-fit: cover;">
              </td>
              <td><?= esc($item['pronombre']) ?></td>
              <td class="text-center">
                <div class="input-group">
                  <input type="number" class="form-control form-control-sm text-center quantity-input"
                    value="<?= esc($item['cicantidad']) ?>" min="1" max="<?= esc($item['procantstock']) ?>"
                    data-id="<?= $item['idcompraitem'] ?>">
                </div>
                <small class="fw-bold">Stock: <?= esc($item['procantstock']) ?></small>
              </td>
              <td class="text-center unit-price">$<?= number_format($item['precioproducto'], 2, ',', '.') ?></td>
              <td class="text-center">
                <span class="item-total">$<?= number_format($item['precioproducto'] * $item['cicantidad'], 2, ',', '.') ?></span>
              </td>
              <td class="text-center">
                <button class="btn btn-sm delete-item" data-id="<?= $item['idcompraitem'] ?>" title="Eliminar producto del carrito">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="text-center">El carrito está vacío.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <div class="total-container mb-5">
      <div class="total-box">
        <h3>Total: $<span id="cart-total"><?= number_format($cartTotal, 2, ',', '.') ?></span></h3>
      </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
      <a href="<?= base_url('/products') ?>" class="btn btn-bd-primary">
        <i class="fas fa-arrow-left"></i> Seguir comprando
      </a>
      <button id="confirm-purchase" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">
        Comprar <i class="fas fa-shopping-cart"></i>
      </button>
    </div>
  </div>

  <!-- Overlay y Loader -->
<div id="fullpage-loader" class="overlay d-none">
  <div class="loader-container">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Cargando...</span>
    </div>
    <p class="mt-3">Procesando la compra, aguarde por favor...</p>
  </div>
</div>


  <!-- Modal de Confirmación de Compra -->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirmar Compra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro de que deseas realizar la compra?</p>
        <div id="loader" class="text-center d-none">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Cargando...</span>
          </div>
          <p>Procesando, por favor espere...</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" id="modal-confirm" class="btn btn-primary">Confirmar</button>
      </div>
    </div>
  </div>
</div>


  <!-- Modal de Actualización de Cantidad -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Actualización</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-body">
          <!-- El mensaje será insertado aquí -->
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('javascript/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('javascript/cart.js'); ?>"></script>

  <?= view('estructura/footer'); ?>

</body>

</html>
