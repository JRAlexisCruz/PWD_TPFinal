<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script type="text/javascript" src="<?= base_url('javascript/jquery.min.js') ?>"></script>
    <title>Mis compras</title>
</head>

<body>
    <?= view('estructura/header') ?>
    <h1 class="text-center" style="margin:30px 0">Mis compras</h1>
    <main class="d-flex flex-column" style="gap:50px">

    </main>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirmar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Esta seguro que quiere cancelar la compra?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="cancel()">Si</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <?= view('estructura/footer') ?>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "<?= base_url('perfil/compras/listarCompras') ?>",
                data: {},
                dataType: "json",
                success: function(response) {
                    $.each(response.compras, function(index, compra) {
                        crearFormCompra(compra);
                    });
                }
            });
            var idcompramodal;

        });

        function crearFormCompra(compra) {
            if(compra.productos.length!=0){
                let fecha = $('<p> Fecha: '+compra.cofecha.split(' ')[0]+' </p>') ;
                fecha.css('font-weight', 'bold');
                fecha.css('font-size', '20px');
                let nuevaTable = $('<table> <thead> <tr> <th>Imagen</th> <th>Nombre del Producto</th> <th>Cantidad</th> <th>Precio Unitario</th> <th>Precio Total</th> </tr> </thead> <tbody> </tbody> </table>')
                nuevaTable.addClass('table');
                nuevaTable.attr('id', 'compra_' + compra.idcompra);
                let thead = nuevaTable.find('thead');
                thead.addClass('table');
                let th = thead.find('th');
                th.addClass('text-center');
                tableBody = nuevaTable.find('tbody');
                tableBody.addClass('table-group-divider');
                let total = 0;
                $.each(compra.productos, function(index, producto) {
                    let row = $('<tr></tr>');
                    let tdImagen = $('<td></td>').attr('class', 'text-center');
                    let img = $('<img>').attr('src', "../images/" + producto.proimagen + '.jpg').attr('alt', producto.pronombre).attr('class', 'rounded-circle').attr('style', 'width: 80px; height: 80px; object-fit: cover;');
                    tdImagen.append(img);
                    row.append(tdImagen);
                    let tdNombre = $('<td></td>').attr('class', 'text-center').text(producto.pronombre);
                    row.append(tdNombre);
                    let tdCantidad = $('<td></td>').attr('class', 'text-center').text(producto.cicantidad);
                    row.append(tdCantidad);
                    let tdUnitario = $('<td></td>').attr('class', 'text-center').text("$" + producto.precioproducto);
                    row.append(tdUnitario);
                    let tdTotal = $('<td></td>').attr('class', 'text-center').text("$" + producto.precioproducto * producto.cicantidad);
                    total += producto.precioproducto * producto.cicantidad;
                    row.append(tdTotal);
                    tableBody.append(row);
                });
                let estado = $('<p></p>').text('Estado: '+compra.estado);
                estado.css('font-weight', 'bold');
                estado.css('padding', '7px 7px');
                estado.css('margin', '0');
                estado.css('margin-left', '30px');
                estado.css('margin-top', '10px');
                estado.css('margin-bottom', '5px');
                estado.css('color','white')
                switch (compra.estado) {
                    case 'Ingresada al carrito':
                        estado.css('background-color', '#6c757d');
                        break;
                    case 'Confirmada':
                        estado.css('background-color', 'green');
                        break;
                    case 'En preparacion':
                        estado.css('background-color', '#007bff');
                        break;
                    case 'Enviada a destino':
                        estado.css('background-color', '#fd7e14');
                        break;
                    case 'Recibida por el cliente':
                        estado.css('background-color', '#ffc107');
                        break;
                    case 'Cancelada por el cliente':
                        estado.css('background-color', '#28a745');
                        break;
                    case 'Cancelada por el administrador':
                        estado.css('background-color', '#dc3545');
                        break;
                }
                let divEstado = $('<div></div>').attr('class', 'd-flex justify-content-between align-items-center');
                divEstado.css('background-color', 'rgb(242, 242, 242)');
                divEstado.append(estado);
                let footer = $('<div></div>').attr('class', 'd-flex justify-content-between align-items-center');
                footer.css('background-color', 'rgb(242, 242, 242)');
                let pTotal = $('<p></p>').text('Total: $' + total);
                pTotal.css('padding-left', '30px');
                pTotal.css('margin', '0');
                pTotal.css('font-size', '20px');
                footer.append(pTotal);
                if (compra.estado == 'Confirmada') {
                    let button = $('<button></button>').attr('class', 'btn btn-danger').attr('onclick', 'openModal(this)').text('Cancelar compra');
                    button.css('margin-right', '30px');
                    let input = $('<input>').attr('type', 'hidden').val(compra.idcompra);
                    footer.append(button);
                    footer.append(input);
                }
                footer.css('padding-bottom', '10px');
                let div = $('<div></div>').attr('class', 'container mt4');
                div.append(fecha);
                div.append(nuevaTable);
                div.append(divEstado);
                div.append(footer);
                $('main').append(div);
            }
        }

        function openModal(boton) {
            $("#staticBackdrop").modal('show');
            idcompramodal = $(boton).next().val();
            console.log(idcompramodal);
        }

        function closeModal() {
            $("#staticBackdrop").modal('hide');
        }

        function cancel() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('perfil/compras/cancelar') ?>",
                data: {
                    idcompra: idcompramodal
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $("main").empty();
                        $.each(response.compras, function(index, compra) {
                            crearFormCompra(compra);
                        });
                        closeModal();
                    }
                }
            });
            
        }
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>