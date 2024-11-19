<html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <br>
    <!-- Carrusel de Ofertas -->
    <section id="offers" class="py-4">
        <div class="container-fluid px-0">
            <h2 class="text-center mb-4"><strong>Ofertas Especiales</strong></h2>
            <div id="offersCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="<?= base_url('images/oferta1.jpg') ?>" class="d-block w-100" alt="Oferta 1">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="<?= base_url('images/oferta2.jpg') ?>" class="d-block w-100" alt="Oferta 2">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="<?= base_url('images/oferta3.jpg') ?>" class="d-block w-100" alt="Oferta 3">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="<?= base_url('images/oferta4.jpg') ?>" class="d-block w-100" alt="Oferta 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#offersCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#offersCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
    </section>
    </br></br>
    <div class="d-flex justify-content-center my-4">
        <h2 class="text-center"> <strong>#CebandoHistorias:</strong></br>
            Es la tradición de compartir momentos únicos alrededor del mate, </br>
            un símbolo de unión, amistad y charlas interminables.</br>
            En nuestra tienda, queremos llevar esa misma esencia a cada producto,</br>
            ofreciendo calidad y calidez en cada detalle. Aquí, cada mate cuenta una historia, </br>
            ¡y queremos que formes parte de ella!</h2>
        </br></br>
    </div>
    <!-- Sección Productos Más Vendidos -->
    <div class="d-flex justify-content-center my-4">
        <section id="products" class="py-5">
            <div class="container">
                <h2 class="text-center mb-4"><strong>Productos Más Vendidos</h2>
                <div class="row g-4">
                    <!-- Producto 1 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100">

                            <img src="<?= base_url('images/mate.jpg') ?>" class="card-img-top" style="height: 500px; object-fit: cover;" alt="Mate Stanley">

                            <div class="card-body">
                                <h5 class="card-title">Mate Stanley</h5>
                                <p class="card-text">Un mate clásico y duradero, perfecto para todos los momentos del día.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price text-success fw-bold">$3000</span>
                                    <a href="#" class="btn btn-sm btn-primary">Agregar al Carrito</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Producto 2 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100">
                            <a>
                                <img src="<?= base_url('images/mas vendido.jpg') ?>" class="card-img-top" style="height: 500px; object-fit: cover;" alt="Mate de Madera">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">Mate de Algarrobo</h5>
                                <p class="card-text">Diseño artesanal con materiales de alta calidad.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price text-success fw-bold">$4800</span>
                                    <a href="#" class="btn btn-sm btn-primary">Agregar al Carrito</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Producto 3 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100">
                            <a>
                                <img src="<?= base_url('images/bombilla.jpg') ?>" class="card-img-top" style="height: 500px; object-fit: cover;" alt="Bombilla Clásica">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">Bombilla Semi Recta</h5>
                                <p class="card-text">Diseño sencillo, ideal para acompañar cualquier mate.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price text-success fw-bold">$2500</span>
                                    <a href="#" class="btn btn-sm btn-primary">Agregar al Carrito</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </br>
    </main>


</body>

</html>
<?php include 'footer.php'; ?>