<?php 
//session_start();
?>
 <!--
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
-->

<body>
<nav class="navbar navbar-expand-lg sticky-top text-white" style="background-color: #955F36;">
    <div class="container-fluid d-flex justify-content-between align-items-center w-100">
        <!-- Logo y Título a la izquierda -->
        <div class="d-flex align-items-center">
            <a class="navbar-brand" href="<?=base_url('home')?>">
                <img src="<?=base_url('images/Logo.jpg')?>" alt="Cebando Historias" class="rounded-circle" style="height: 50px; width: 50px;">
            </a>
            <h1 class="ms-3 mb-0">#CebandoHistorias</h1>
        </div>
   
         <!-- Menú a la izquierda -->
         <div class="collapse navbar-collapse ms-auto" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link text-white fs-4" href="<?=base_url('products')?>"><i class="fa-solid fa-bag-shopping"></i> Productos  </a></li>
                <li class="nav-item"><a class="nav-link text-white fs-4" href="<?=base_url('nosotros')?>"><i class="fa-solid fa-users"></i> Nosotros  </a></li>
                <li class="nav-item"><a class="nav-link text-white fs-4" href="<?=base_url('admin')?>"><i class="fas fa-cogs"></i> Administración  </a></li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-4" href="<?=base_url('login')?>"><i class="fa-solid fa-user"></i> Iniciar Sesión  </a>
                    <a class="nav-link text-white fs-4" href="<?=base_url('logout')?>"> <i class="fa-solid fa-right-to-bracket"></i> Cerrar Sesión  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-4" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->

</body>
</html>
