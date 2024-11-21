<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url('javascript/jquery.min.js') ?>"></script>
    <title>Mis compras</title>
</head>

<body>
    <h1>Mis Compras</h1>
    <main class="d-flex flex-column" style="gap:15px">

    </main>

    <div class="card" style="width:fit-content;display:none;min-width:30%" id="compra-example">
        <div class="card-header d-flex justify-content-between">
            <p id="compra-fecha">12/12/2012</p>
            <p id="compra-estado">Confirmada</p>
        </div>
        <div class="card-body d-flex justify-content-center" style="gap:10px" id="compra-body">

        </div>
        <div class="card-footer d-flex justify-content-between" id="compra-footer">
            <p id="compra-total">Total: $1000</p>
            <button type="button" class="btn btn-danger" style="display:none" id="cancelar" onclick="openModal(this)">Cancelar</button>
            <input type="hidden" name="idcompra" id="idcompra">
        </div>

    </div>

    <div class="card" style="width:fit-content;display:none" id="producto-example">
        <img src="" class="card-img-top" alt="" style="width:100%;height:120px" id="producto-imagen">
        <div class="card-body">
            <h5 class="card-title" id="producto-nombre">Bombilla</h5>
            <p class="card-text" id="producto-precio">Precio unitario: $1000</p>
            <p class="card-text" id="producto-cantidad">Cantidad: 2</p>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cancelar compra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro que desea cancelar la compra?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="cancel()">Si</button>
                    <button type="button" class="btn btn-danger" onclick="closeModal()">No</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "<?= base_url('perfil/compras/listarCompras') ?>",
                data: {},
                dataType: "json",
                success: function(response) {
                    $.each(response.compras, function(index, compra) {
                        crearCardCompra(compra);
                    });
                }
            });
            var idcompramodal;

        });

        function crearCardCompra(compra) {
            let compraCard = $("#compra-example").clone();
            compraCard.attr("id", "compra-" + compra.idcompra);
            compraCard.find("#compra-fecha").text(compra.cofecha);
            compraCard.find("#compra-estado").text(compra.estado);
            compraCard.find("#idcompra").val(compra.idcompra);
            if (compra.estado === "confirmada") {
                compraCard.find("#cancelar").show();
            } else {
                compraCard.find("#cancelar").hide();
            }
            let total=0;
            $.each(compra.productos, function(index, producto) {
                let productoCard = $("#producto-example").clone();
                productoCard.find("#producto-nombre").text(producto.pronombre);
                productoCard.find("#producto-precio").text("Precio unitario: $" + producto.precioproducto);
                productoCard.find("#producto-cantidad").text("Cantidad: " + producto.cicantidad);
                productoCard.find("#producto-imagen").attr("src", "http://localhost/PWD/PWD_TPFinal/public/" + producto.proimagen);
                total+=producto.precioproducto*producto.cicantidad;
                productoCard.show();
                compraCard.find("#compra-body").append(productoCard);
            });
            compraCard.find("#compra-total").text("Total: $" + total);
            compraCard.show();
            $("main").append(compraCard);
        }

        function openModal(boton) {
            $("#staticBackdrop").modal('show');
            idcompramodal = $(boton).next().val();
            console.log(idcompramodal);
        }

        function closeModal() {
            $("#staticBackdrop").modal('hide');
            console.log(idcompramodal);
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
                            crearCardCompra(compra);
                        });
                    }
                }
            });
            closeModal();
        }
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>