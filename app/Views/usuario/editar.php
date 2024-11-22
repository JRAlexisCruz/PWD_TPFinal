<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url('javascript/jquery.min.js') ?>"></script>

    <link rel="stylesheet" href="<?= base_url('/css/styles.css') ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Editar</title>
</head>

<body>
    <?= view('estructura/header'); ?>
    <main class="d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex flex-column align-items-center form-container py-4" style="width: 100%; max-width: 400px; margin: 0 auto; height: auto;">
            <form id="editarUsuario" class="mt-3" method="post">
                <div class="text-center mb-4">
                    <h1 style="width:100%">Editar Usuario</h1>
                </div>
                <!-- Nombre de usuario -->
                <div class="input-group mt-3">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Nombre de usuario" aria-label="Username" name="usnombre" id="usnombre">
                </div>
                <div id="error-usnombre" class="mb-3"></div>

                <!-- Email -->
                <div class="input-group mt-3">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input type="text" class="form-control" placeholder="Email" aria-label="Email" name="usmail" id="usmail">
                </div>
                <div id="error-usmail" class="mb-3"></div>

                <!-- Contraseña -->
                <div class="input-group mt-3">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="text" class="form-control" placeholder="Contraseña" aria-label="Password" name="uspass" id="uspass" disabled>
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal" data-bs-whatever="@mdo">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </div>
                <p class="text-danger" style="display:none;" id="msg"></p>
                <button class="btn btn-primary mt-3" id="submit" style="width:100%; display:none;">Guardar</button>
            </form>

            <!-- Modal para editar la contraseña -->
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ingrese su contraseña</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="password" class="form-control" id="uspassmodal" name="uspass" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="ingresar">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script>
        $(document).ready(function() {
            var usnombreinicial;
            var usmailinicial;
            var uspassinicial;

            cargar();

            $('#usnombre').on('change', function() {
                if ($('#usnombre').val() != usnombreinicial || $('#usmail').val() != usmailinicial || $('#uspass').val() != uspassinicial) {
                    $('#submit').show();
                } else {
                    $('#submit').hide();
                }
            });

            $('#usmail').on('change', function() {
                if ($('#usnombre').val() != usnombreinicial || $('#usmail').val() != usmailinicial || $('#uspass').val() != uspassinicial) {
                    $('#submit').show();
                } else {
                    $('#submit').hide();
                }
            });

            $('#uspass').on('change', function() {
                if ($('#usnombre').val() != usnombreinicial || $('#usmail').val() != usmailinicial || $('#uspass').val() != uspassinicial) {
                    $('#submit').show();
                } else {
                    $('#submit').hide();
                }
            });

            $('#submit').on('click', function() {
                let nombreValido = false;
                let emailValido = false;
                let passValido = false;
                if ($('#uspass').val() == '') {
                    pass = '';
                } else {
                    pass = CryptoJS.SHA256($('#uspass').val()).toString();
                }
                if ($('#usnombre').val() == '') {
                    $('#error-usnombre').text('El nombre de usuario no puede estar vacío');
                    $('#error-usnombre').show();

                } else {
                    $('#error-usnombre').hide();
                    nombreValido = true;
                }
                if ($('#usmail').val() == '') {
                    $('#error-usmail').text('El email no puede estar vacío');
                    $('#error-usmail').show();
                } else {
                    if (!validarEmail($('#usmail').val())) {
                        $('#error-usmail').text('El email no es válido');
                        $('#error-usmail').show();
                    } else {
                        $('#error-usmail').hide();
                        emailValido = true;
                    }
                }
                if ($('#uspass').val() == '') {
                    $('#error-uspass').text('La contraseña no puede estar vacía');
                    $('#error-uspass').show();
                } else {
                    $('#error-uspass').hide();
                    passValido = true;
                }

                if (nombreValido && emailValido && passValido) {
                    $.ajax({
                        url: '<?= base_url('perfil/editar') ?>',
                        type: 'POST',
                        data: {
                            usnombre: $('#usnombre').val(),
                            usmail: $('#usmail').val(),
                            uspass: pass
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.success) {
                                $('#msg').text(data.msg);
                                $('#msg').removeClass('alert alert-danger');
                                $('#msg').addClass('alert alert-success');
                                $('#msg').show();
                                cargar();
                            } else {
                                $('#msg').text(data.msg);
                                $('#msg').removeClass('alert alert-success');
                                $('#msg').addClass('alert alert-danger');
                                $('#msg').show();
                            }
                            $('#submit').hide();
                            $('#uspass').attr('disabled', 'true');
                            $('#edit').show();
                        }
                    });
                }

            });

            $('#edit').on('click', function() {
                $('#modal').show();
            });

            $('#ingresar').on('click', function() {
                verificar();
            });


            function cargar() {
                $.ajax({
                    url: '<?= base_url('perfil/buscar') ?>',
                    type: 'GET',
                    data: {
                        idusuario: <?= session('idusuario') ?>
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#usnombre').val(data.usnombre);
                        $('#usmail').val(data.usmail);
                        $('#uspass').val('');
                        usnombreinicial = data.usnombre;
                        usmailinicial = data.usmail;
                    }
                });
            }

            function verificar() {
                var pass = $('#uspassmodal').val();
                var passencriptada = CryptoJS.SHA256(pass).toString();
                $.ajax({
                    url: '<?= base_url('perfil/verificar') ?>',
                    type: 'POST',
                    data: {
                        uspass: passencriptada
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            $('#uspass').removeAttr('disabled');
                            $('#uspass').val(pass);
                            uspassinicial = pass;
                            $('#msg').text('');
                            $('#msg').removeClass('alert alert-danger');
                            $('#msg').hide();
                            $('#edit').hide();
                        } else {
                            $('#uspass').attr('disabled', 'true');
                            $('#msg').text(data.msg);
                            $('#msg').addClass('alert alert-danger');
                            $('#msg').show();
                        }

                    }
                });
            }

            function validarEmail(email) {
                var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                return regex.test(email);
            }

        });
    </script>
    <?= view('estructura/footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>