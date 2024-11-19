<?php 
session_start();
?>

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
<nav class="navbar navbar-expand-lg sticky-top text-white" style="background-color: #955F36;">
    <div class="container-fluid d-flex justify-content-between align-items-center w-100">
        <!-- Logo y Título a la izquierda -->
        <div class="d-flex align-items-center">
            <a class="navbar-brand" href="index.php">
                <img src="https://media.istockphoto.com/id/1256867958/es/vector/yerba-mate-drink-vector-icon-isolated-chimarr%C3%A3o-cimarr%C3%B3n-yerba-mate-symbol-vector.jpg?s=612x612&w=0&k=20&c=i48thdDY6FrxY_jmjPN4mvoxxFdEAIiLFXvXF-Wf6tM=" alt="Cebando Historias" class="rounded-circle" style="height: 50px; width: 50px;">
            </a>
            <h1 class="ms-3 mb-0">CebandoMates</h1>
        </div>
   
         <!-- Menú a la izquierda -->
         <div class="collapse navbar-collapse ms-auto" id="navbarNav">
            <ul class="navbar-nav ms-auto">
               <li class="nav-item"><a class="nav-link text-white fs-4" href="../public/home.php"><i class="fa-solid fa-house"></i> Inicio</a></li>
                <li class="nav-item"><a class="nav-link text-white fs-4" href="#products"><i class="fa-solid fa-bag-shopping"></i> Productos</a></li>
                <li class="nav-item"><a class="nav-link text-white fs-4" href="../public/nosotros.php"><i class="fa-solid fa-handshake"></i> Nosotros</a></li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-4" href="cart.php"><i class="fas fa-shopping-cart"></i> Carrito</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>