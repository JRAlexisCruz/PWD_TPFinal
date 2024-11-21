    <header>
        <?php
            $roles = [];
            if(session()->has('roles')){
                $roles= session()->get('roles'); 
            }
            $loggedIn=false;
            if(session()->has('idusuario')){
                $loggedIn=true;
            }
            $esAdmin=false;
            if(session()->has('rol')){
                if(session()->get('rol')==1 || session()->get('rol')==2){
                    $esAdmin=true;
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

                <!-- Menú a la izquierda -->
                <div class="collapse navbar-collapse ms-auto" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link text-white fs-4" href="<?= base_url('products') ?>"><i class="fa-solid fa-bag-shopping"></i> Productos </a></li>
                        <li class="nav-item"><a class="nav-link text-white fs-4" href="<?= base_url('nosotros') ?>"><i class="fa-solid fa-users"></i> Nosotros </a></li>
                        <?php if($esAdmin): ?>
                            <li class="nav-item">
                                <a class="nav-link text-white fs-4" href="<?= base_url('admin') ?>"><i class="fas fa-cogs"></i> Administración </a>
                            </li>
                        <?php endif; ?>
                        <?php if($loggedIn): ?>
                        <li>
                            <a class="nav-link text-white fs-4" href="<?= base_url('logout') ?>"> <i class="fa-solid fa-right-to-bracket"></i> Cerrar Sesión </a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-4" href="<?= base_url('login') ?>"><i class="fa-solid fa-user"></i> Iniciar Sesión </a>
                        </li>
                        
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-4" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                        </li>
                        <?php if(count($roles)>1): ?>
                            <form action="<?=base_url('cambioRol')?>">
                                <select name="idrol" id="idrol" class="form-select" onchange="this.form.submit()">
                                    <?php foreach($roles as $rol): ?>
                                        <?php if($rol['idrol'] == session()->get('rol')): ?>
                                            <option value="<?=$rol['idrol']?>" selected><?=$rol['rodescripcion']?></option>
                                        <?php else: ?>
                                        <option value="<?=$rol['idrol']?>"><?=$rol['rodescripcion']?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>