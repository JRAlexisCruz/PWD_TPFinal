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
              <!-- Imagen en miniatura -->
              <td class="text-center">
                <img src="<?= base_url('images/' . esc($item['proimagen'])) ?>.jpg"
                  alt="<?= esc($item['pronombre']) ?>"
                  class="rounded-circle"
                  style="width: 80px; height: 80px; object-fit: cover;">
              </td>

              <!-- Nombre del producto -->
              <td><?= esc($item['pronombre']) ?></td>

              <!-- Cantidad con botones -->
              <td class="text-center">
                <div class="input-group">

                  <input type="number"
                    class="form-control form-control-sm text-center quantity-input"
                    value="<?= esc($item['cicantidad']) ?>"
                    min="1"
                    max="<?= esc($item['procantstock']) ?>"
                
                    data-id="<?= $item['idcompraitem'] ?>">

                </div>
                <small class="fw-bold">Stock: <?= esc($item['procantstock']) ?></small>
              </td>

              <!-- Precio unitario -->
              <td class="text-center unit-price">$<?= number_format($item['precioproducto'], 2, ',', '.') ?></td>

              <!-- Precio total -->
              <td class="text-center">
                <span class="item-total">$<?= number_format($item['precioproducto'] * $item['cicantidad'], 2, ',', '.') ?></span>
              </td>


              <!-- Botón eliminar -->
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

    <!-- Contenedor total -->
    <div class="total-container mb-5">
      <div class="total-box">
        <h3>Total: $<span id="cart-total"><?= number_format($cartTotal, 2, ',', '.') ?></span></h3>
      </div>
    </div>

    <!-- Botones de acción -->
    <div class="d-flex justify-content-between mt-4">
      <a href="<?= base_url('/products') ?>" class="btn btn-bd-primary">
        <i class="fas fa-arrow-left"></i> Seguir comprando
      </a>
      <a href="<?= base_url('/checkout') ?>" class="btn btn-danger">
        Comprar <i class="fas fa-shopping-cart"></i>
      </a>
    </div>
  </div>


  <!-- JS de Bootstrap -->
  <script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('javascript/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('javascript/cart.js'); ?>"></script>

  <?= view('estructura/footer'); ?>

</body>

</html>