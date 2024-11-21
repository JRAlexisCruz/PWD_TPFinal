<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url('javascript/jquery.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Editar</title>
</head>

<body>
    <div class="mb-3">
        <label for="usnombre" class="form-label">Nombre de Usuario</label>
        <input type="text" class="form-control" id="usnombre" name="usnombre">
    </div>
    <div class="mb-3">
        <label for="usmail" class="form-label">Email</label>
        <input type="text" class="form-control" id="usmail" name="usmail">
    </div>
    <div class="mb-3">
        <label for="uspass" class="form-label">Contraseña</label>
        <input type="text" class="form-control" id="uspass" name="uspass" disabled>
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal" data-bs-whatever="@mdo"><i class="fa-solid fa-pen-to-square" id="edit"></i></button>
    </div>
    <p class="" style="display:none;" id="msg"></p>
    <button class="btn btn-primary" id="submit" style="display:none;">Guardar</button>

    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingrese su contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="uspassmodal" name="uspass" placeholder="Contraseña">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="ingresar">Ingresar</button>
                </div>
            </div>
        </div>
    </div>

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
                if($('#uspass').val() == ''){
                    pass = '';
                }else{
                    pass = CryptoJS.SHA256($('#uspass').val()).toString();
                }
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
                cargar();
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

            function verificar(){
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

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>