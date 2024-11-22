<header>
    <?php
    $roles = [];
    if (session()->has('roles')) {
        $roles = session()->get('roles');
    }
    $loggedIn = false;
    if (session()->has('idusuario')) {
        $loggedIn = true;
    }
    $esAdmin = false;
    if (session()->has('rol')) {
        if (session()->get('rol') == 1 || session()->get('rol') == 2) {
            $esAdmin = true;
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg sticky-top text-white" style="background-color: #955F36;">
        <div class="container-fluid d-flex justify-content-between align-items-center w-100">
            <!-- Logo y Título a la izquierda -->
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="<?= base_url('home') ?>">
                    <img src="<?= base_url('images/Logo.jpg') ?>" alt="Cebando Historias" class="rounded-circle" style="height: 50px; width: 50px;">
                </a>
                <h1 class="ms-3 mb-0">#CebandoHistorias</h1>
            </div>

            <!-- Menú de navegación -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-auto" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-white fs-6 nav-hover" href="<?= base_url('products') ?>"><i class="fa-solid fa-bag-shopping"></i> Productos </a></li>
                    <li class="nav-item"><a class="nav-link text-white fs-6 nav-hover" href="<?= base_url('nosotros') ?>"><i class="fa-solid fa-users"></i> Nosotros </a></li>
                    <?php if ($esAdmin): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-6 nav-hover" href="<?= base_url('admin') ?>"><i class="fas fa-cogs"></i> Administración </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($loggedIn): ?>

                        <div class="dropdown">
                            <button class="btn dropdown-toggle nav-hover text-white" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-circle-user"></i>
                            </button>

                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><?= $_COOKIE['usnombre'] ?></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= base_url('perfil/editar') ?>">Editar perfil</a></li>
                                <?php if(!$esAdmin): ?>
                                    <li><a class="dropdown-item" href="<?= base_url('perfil/compras') ?>">Mis compras</a></li>
                                <?php endif; ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Cerrar sesión</a></li>
                            </ul>
                        </div>
                        </l>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-6 nav-hover" href="<?= base_url('login') ?>"><i class="fa-solid fa-user"></i> Iniciar Sesión </a>
                        </li>
                    <?php endif; ?>
                    <?php if (!$esAdmin): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-6 nav-hover" href="<?= base_url('cart') ?>"><i class="fas fa-shopping-cart"></i></a>
                        </li>
                    <?php endif; ?>

                    <?php if (count($roles) > 1): ?>
                        <form action="<?= base_url('cambioRol') ?>" class="d-flex align-items-center">
                            <select name="idrol" id="idrol" class="form-select" onchange="this.form.submit()">
                                <?php foreach ($roles as $rol): ?>
                                    <?php if ($rol['idrol'] == session()->get('rol')): ?>
                                        <option value="<?= $rol['idrol'] ?>" selected><?= $rol['rodescripcion'] ?></option>
                                    <?php else: ?>
                                        <option value="<?= $rol['idrol'] ?>"><?= $rol['rodescripcion'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <style>
        .nav-hover {
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .nav-hover:hover {
            color: #955F36 !important;
            background-color: #FFF !important;
            border-radius: 5px;
        }

        .dropdown-menu {
            background-color: #955F36;
        }

        .dropdown-item {
            color: white;
        }

        .dropdown-item:hover {
            background-color: #FFF !important;
            color: #955F36 !important;
        }

        @media (max-width: 768px) {
            .navbar h1 {
                font-size: 1.2rem;
            }
        }
    </style>
</header>