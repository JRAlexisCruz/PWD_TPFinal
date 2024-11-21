<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administración de Estados de Compra</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('javascript/jquery-easyui-1.11.0/themes/default/easyui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('javascript/jquery-easyui-1.11.0/themes/icon.css') ?>">
    <script type="text/javascript" src="<?= base_url('javascript/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('javascript/jquery-easyui-1.11.0/jquery.easyui.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('javascript/datagrid-detailview.js') ?>"></script>
</head>
<body>
    <!-- Tabla principal -->
    <table id="dg" title="Estados de Compra" class="easyui-datagrid" style="width:100%;height:250px"
           url="<?= base_url('admin/compraestado/listar') ?>"
           toolbar="#toolbar" pagination="true"
           rownumbers="true" fitColumns="true" singleSelect="true" method="get">
        <thead>
            <tr>
                <th field="idcompra" width="50">ID Compra</th>
                <th field="estado" width="50">Estado</th>
                <th field="fechainicio" width="50">Fecha de Inicio</th>
                <th field="fechafin" width="50">Fecha de Fin</th>
                <th field="idcompraestado" width="50">ID Estado</th>
            </tr>
        </thead>
    </table>

    <!-- Toolbar -->
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="add()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroy()">Eliminar</a>
    </div>

    <!-- Diálogo de creación -->
    <div id="dlg-new" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-new'">
        <form id="fm-new" method="post" style="margin:0;padding:20px 50px">
            <h3>Crear Nuevo Estado</h3>
            <div style="margin-bottom:10px">
                <label for="idcompra" style="display:inline-block;width:150px;">ID de Compra:</label>
                <input id="cc" class="easyui-combobox idcompra" name="idcompra" data-options="valueField:'idcompra',textField:'idcompra',url:'<?= base_url('admin/compras/listar') ?>'">
            </div>
            <div style="margin-bottom:10px">
                <label for="estado" style="display:inline-block;width:150px;">Estado:</label>
                <input id="cc" class="easyui-combobox idcompraestadotipo" name="estado" data-options="valueField:'idcompraestadotipo',textField:'cetdescripcion',url:'<?= base_url('admin/estadotipo/listar') ?>'">
            </div>
            <div style="margin-bottom:10px">
                <label for="fechainicio" style="display:inline-block;width:150px;">Fecha de Inicio:</label>
                <input class="easyui-datetimebox fechainicio" name="fechainicio" data-options="showSeconds:false" value="<?= date('Y-m-d H:i:s'); ?>" style="width:150px">
            </div>
        </form>
    </div>
    <div id="dlg-buttons-new">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-new').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <!-- Diálogo de edición -->
    <div id="dlg-edit" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-edit'">
        <form id="fm-edit" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Editar Estado</h3>
            <div style="margin-bottom:10px">
                <label for="idcompraestado" style="display:inline-block;width:150px;">ID Estado:</label>
                <input name="idcompraestado" class="easyui-validatebox idcompraestado" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="estado" style="display:inline-block;width:150px;">Estado:</label>
                <input id="cc" class="easyui-combobox estado" name="estado" data-options="valueField:'idcompraestadotipo',textField:'cetdescripcion',url:'<?= base_url('admin/estadotipo/listar') ?>'">
            </div>
            <div style="margin-bottom:10px">
                <label for="fechainicio" style="display:inline-block;width:150px;">Fecha de Inicio:</label>
                <input class="easyui-datetimebox fechainicio" name="fechainicio" data-options="showSeconds:false" value="<?= date('Y-m-d H:i:s'); ?>" style="width:150px">
            </div>
        </form>
    </div>
    <div id="dlg-buttons-edit">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <script type="text/javascript">
        var url;
        function add(){
            $('#dlg-new').dialog('open').dialog('center').dialog('setTitle','Nuevo Estado de Compra');
            $('#fm-new').form('clear');
            url = "<?= base_url('admin/compraestado/crear') ?>";
        }
        function edit(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg-edit').dialog('open').dialog('center').dialog('setTitle','Editar Estado de Compra');
                $('#fm-edit').form('load',row);
                url = "<?= base_url('admin/compraestado/editar') ?>";
            }
        }
        function save(){
            $('#fm-new, #fm-edit').form('submit', {
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = JSON.parse(result);
                    if (!result.success){
                        $.messager.alert('Error', result.errorMsg, 'error');
                    } else {
                        $('#dlg-new, #dlg-edit').dialog('close');
                        $('#dg').datagrid('reload');
                    }
                }
            });
        }
        function destroy(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmación', '¿Está seguro de eliminar este estado?', function(r){
                    if (r){
                        $.post('<?= base_url('admin/compraestado/eliminar') ?>', {idcompraestado: row.idcompraestado}, function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');
                            } else {
                                $.messager.alert('Error', result.errorMsg, 'error');
                            }
                        }, 'json');
                    }
                });
            }
        }
    </script>
</body>
</html>
