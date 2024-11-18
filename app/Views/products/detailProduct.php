<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalle del Producto</title>
  <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('/css/detailProduct.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/css/styles.css') ?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-4 mb-6">
    <div class="row">
      <!-- Imagen grande del producto -->
      <div class="col-md-6 container-image-description">
        <img src="<?= base_url('images/' . esc($product['proimagen'])) ?>.jpg" class="img-fluid product-image rounded shadow" alt="<?= esc($product['pronombre']); ?>">
      </div>

      <!-- Información del producto -->
      <div class="col-md-6 container-image-description ">
        <h1 class="product-title"><?= esc($product['pronombre']); ?></h1>
        <h3 class="product-price">$<?= number_format($product['precioproducto'], 2, ',', '.'); ?></h3>
        <p class="product-description"><?= esc($product['prodetalle']); ?></p>

        <!-- Selector de cantidad -->
        <div class="box-cantidad mt-3">
          <label for="cantidad" class="form-label me-1"><strong>Cantidad: </strong></label>
          <select id="cantidad" class="form-select" style="width: fit-content;">
            <?php for ($i = 1; $i <= $product['procantstock']; $i++): ?>
              <option value="<?= $i; ?>"><?= $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>

        <!-- Botón para agregar al carrito -->
        <a href="#" class="btn btn-bd-primary btn-lg w-100 mt-3">Agregar al carrito <i class="fa-solid fa-cart-plus"></i></a>
      </div>
    </div>

    <!-- Información adicional sobre cuidado del producto -->
    <div class="row mt-5">
      <div class="col-12">
        <h2 class="section-title"><i class="fa-solid fa-circle-check"></i> RECOMENDACIONES:</h2>

        <?php if ($product['tipoproducto'] === 'mate'): ?>
          <p><strong><span style="color: #565433;">Curado:</span></strong> Antes de usar tu mate de calabaza por primera vez, curalo llenándolo con yerba húmeda y agua tibia. Dejá reposar 24 horas. Luego, enjuagalo y estará listo.</p>
          <p><strong><span style="color: #565433;">Limpieza:</span></strong> Lavá tu mate solo con agua y dejalo secar boca abajo. Evitá jabones o productos químicos.</p>
          <p><strong><span style="color: #565433;">Mantenimiento:</span></strong> No lo dejes con yerba húmeda por más de 24 horas para prevenir hongos.</p>
        <?php elseif ($product['tipoproducto'] === 'bombilla'): ?>
          <p><strong><span style="color: #565433;">Limpieza:</span></strong> Lavá tu bombilla con agua caliente después de cada uso. Utilizá un cepillo pequeño para limpiar el interior si es desmontable.</p>
          <p><strong><span style="color: #565433;">Mantenimiento:</span></strong> Evitá dejar la bombilla sumergida en líquidos para prevenir la oxidación o manchas.</p>
          <p><strong><span style="color: #565433;">Uso:</span></strong> Insertá la bombilla inclinada para evitar obstrucciones al cebar.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- JS de Bootstrap -->
  <script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
</body>

</html>