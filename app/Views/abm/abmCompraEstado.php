<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administración de Estados de Compra</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url('javascript/jquery-easyui-1.11.0/themes/default/easyui.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('javascript/jquery-easyui-1.11.0/themes/icon.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('javascript/jquery-easyui-1.11.0/demo/demo.css')?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="<?=base_url('javascript/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('javascript/jquery-easyui-1.11.0/jquery.easyui.min.js')?>"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
    <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('/css/styles.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?= view('estructura/header'); ?>
    <!-- Tabla principal -->
    <table id="dg" title="Estados de Compra" class="easyui-datagrid" style="width:95%;height:250px"
        url="<?= base_url('admin/estados/listar') ?>"
        toolbar="#toolbar" pagination="true"
        rownumbers="true" fitColumns="true" singleSelect="true" method="get">
        <thead>
            <tr>
                <th field="idcompra" width="50">ID Compra</th>
                <th field="estado" width="50">Estado</th>
                <th field="cefechaini" width="50">Fecha de Inicio</th>
                <th field="cefechafin" width="50">Fecha de Fin</th>
            </tr>
        </thead>
    </table>

    <!-- Toolbar -->
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit()">Editar</a>
    </div>

    <!-- Diálogo de edición -->
    <div id="dlg-edit" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-edit'">
        <form id="fm-edit" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Editar Estado</h3>
            <div style="margin-bottom:10px">
                <label for="idcompraestado" style="display:inline-block;width:150px;">ID Estado:</label>
                <input name="idcompraestado" class="easyui-validatebox idcompraestado" style="width:100%" readonly>
            </div>
            <div style="margin-bottom:10px">
                <label for="estado" style="display:inline-block;width:150px;">ID Compra:</label>
                <input name="idcompra" class="easyui-validatebox idcompra" style="width:100%" readonly>
            </div>
            <div style="margin-bottom:10px">
                <label for="cetfechaini" style="display:inline-block;width:150px;">Fecha de Inicio:</label>
                <input class="easyui-datetimebox fechainicio" name="fechainicio" data-options="showSeconds:false" value="<?= date('Y-m-d H:i:s'); ?>" style="width:150px" readonly>
            </div>
        </form>
    </div>
    <div id="dlg-buttons-edit">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="update()" style="width:100px">Actualizar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="cancel()" style="width:100px">Cancelar</a>
    </div>

    <script type="text/javascript">
        var url;

        function edit() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                if(row.estado == 'Cancelada por el cliente' || row.estado == 'Cancelada por el administrador' || row.estado == 'Recibida por el cliente'){
                    $.messager.alert('Error', 'No se puede editar un estado cancelado o recibido', 'error');
                    return;
                }else{
                    $('#dlg-edit').dialog('open').dialog('center').dialog('setTitle', 'Editar Estado de Compra');
                    $('#fm-edit').form('load', row);
                }   
            }
        }

        function update(){
            url="<?= base_url('admin/estados/actualizar') ?>";
            save();
        }

        function cancel() {
            var row = $('#dg').datagrid('getSelected');
            if(row.estado == 'Enviada a destino' || row.estado == 'Recibida por el cliente' ){
                $('#dlg-edit').dialog('close');
                $.messager.alert('Error', 'No se puede cancelar esta compra', 'error');
                return;
            }
            url="<?= base_url('admin/estados/cancelar') ?>";
            save();
        }

        function save() {
            $('#fm-edit').form('submit', {
                url: url,
                onSubmit: function() {
                    return $(this).form('validate');
                },
                success: function(result) {
                    try{
                        var result = eval('(' + result + ')');
                    if (!result.success) {
                        $.messager.alert('Error', result.errorMsg, 'error');
                    } else {
                        $('#dlg-edit').dialog('close');
                        $('#dg').datagrid('reload');
                    }
                    }catch(e){

                    }
                }
            });
        }
    </script>
    <?= view('estructura/footer'); ?>
    <script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
</body>

</html>