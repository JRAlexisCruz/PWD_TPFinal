<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito de Compras</title>
  <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/styles.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/css/cart.css') ?>"> <!-- Archivo CSS adicional si necesitas -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-4">
    <h1 class="text-center mb-4">Carrito de Compras</h1>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Precio Total</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($cartItems)): ?>
          <?php foreach ($cartItems as $item): ?>
            <tr>
              <!-- Imagen en miniatura -->
              <td class="text-center">
                <img src="<?= base_url('images/' . esc($item['proimagen'])) ?>" 
                     alt="<?= esc($item['pronombre']) ?>" 
                     class="img-thumbnail" 
                     style="width: 80px; height: 80px; object-fit: cover;">
              </td>

              <!-- Nombre del producto -->
              <td><?= esc($item['pronombre']) ?></td>

              <!-- Cantidad con botones -->
              <td class="text-center">
                <div class="input-group">
                  <button class="btn btn-outline-secondary btn-sm decrease-quantity" 
                          data-id="<?= $item['idproducto'] ?>">-</button>
                  <input type="number" 
                         class="form-control form-control-sm text-center quantity-input" 
                         value="<?= $item['cantidad'] ?>" 
                         min="1" 
                         max="<?= $item['procantstock'] ?>" 
                         data-id="<?= $item['idproducto'] ?>">
                  <button class="btn btn-outline-secondary btn-sm increase-quantity" 
                          data-id="<?= $item['idproducto'] ?>">+</button>
                </div>
                <small class="text-muted">Stock: <?= $item['procantstock'] ?></small>
              </td>

              <!-- Precio unitario -->
              <td class="text-center">$<?= number_format($item['precioproducto'], 2, ',', '.') ?></td>

              <!-- Precio total -->
              <td class="text-center">
                $<span class="item-total"><?= number_format($item['cantidad'] * $item['precioproducto'], 2, ',', '.') ?></span>
              </td>

              <!-- Botón eliminar -->
              <td class="text-center">
                <button class="btn btn-danger btn-sm delete-item" data-id="<?= $item['idproducto'] ?>">
                  <i class="fas fa-trash"></i> Eliminar
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

    <!-- Total general -->
    <div class="text-end">
      <h3>Total: $<span id="cart-total"><?= number_format($cartTotal, 2, ',', '.') ?></span></h3>
    </div>

    <!-- Botones de acción -->
    <div class="d-flex justify-content-between mt-4">
      <a href="<?= base_url('/products') ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Seguir comprando
      </a>
      <a href="<?= base_url('/checkout') ?>" class="btn btn-primary">
        Comprar <i class="fas fa-shopping-cart"></i>
      </a>
    </div>
  </div>

  <!-- JS de Bootstrap -->
  <script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('javascript/cart.js'); ?>"></script>

  
</body>

</html>
