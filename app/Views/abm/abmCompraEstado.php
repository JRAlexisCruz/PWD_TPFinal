<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administracion de Compras</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url('javascript/jquery-easyui-1.11.0/themes/default/easyui.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('javascript/jquery-easyui-1.11.0/themes/icon.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('javascript/jquery-easyui-1.11.0/demo/demo.css')?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="<?=base_url('javascript/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('javascript/jquery-easyui-1.11.0/jquery.easyui.min.js')?>"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
</head>
<body>
    <table id="dg" title="Usuarios" class="easyui-datagrid" style="width:100%;height:250px"
            url="<?=base_url('admin/estados/listar')?>"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true" method="get">
        <thead>
            <tr>
                <th field="idcompra" width="50">ID Compra</th>
                <th field="estado" width="50">Estado</th>
                <th field="fechainicio" width="50">Fecha de Inicio</th>
                <th field="fechafin" width="50">Fecha de Fin</th>
                <th field="idcompraestado" width="50">ID Estado de Compra</th>
            </tr>
        </thead>
    </table>

    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="add()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edit()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroy()">Eliminar</a>
    </div>
    
    <div id="dlg-new" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-new'">
        <form id="fm-new" method="post" style="margin:0;padding:20px 50px">
            <h3>Informacion del Estado de Compra</h3>
            <div style="margin-bottom:10px">
                <label for="idcompra" style="display:inline-block;width:150px;">ID de Compra:</label>
                <input id="cc" class="easyui-combobox idcompra" name="idcompra" data-options="valueField:'idcompra',textField:'idcompra',url:'<?=base_url('admin/compras/listar')?>'">
            </div>
            <div style="margin-bottom:10px">
                <label for="estado" style="display:inline-block;width:150px;">Estado:</label>
                <input id="cc" class="easyui-combobox idcompraestadotipo" name="estado" data-options="valueField:'idcompraestadotipo',textField:'cetdescripcion',url:'<?=base_url('admin/estadotipo/listar')?>'">
            </div>
            <div style="margin-bottom:10px">
                <label for="cetfechainicio" style="display:inline-block;width:150px;">Fecha de Inicio:</label>
                <input class="easyui-datetimebox cetfechainicio" name="cetfechainicio" data-options="showSeconds:false" value="<?=date('d/m/Y H:i');?>" style="width:150px">
            </div>
            <div style="margin-bottom:10px">
                <label for="cetfechafin" style="display:inline-block;width:150px;">Fecha de Fin:</label>
                <input class="easyui-datetimebox cetfechafin" name="cetfechafin" data-options="showSeconds:false" value="01/01/2000 0:0" style="width:150px">
            </div>
        </form>
    </div>
    <div id="dlg-buttons-new">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-new').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <div id="dlg-edit" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-edit'">
        <form id="fm-edit" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion del Estado de Compra</h3>
            <div style="margin-bottom:10px">
                <label for="idcompraestado" style="display:inline-block;width:150px;">ID de Estado de Compra:</label>
                <input name="idcompraestado" class="easyui-validatebox idcompraestado" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="idcompra" style="display:inline-block;width:150px;">ID de Compra:</label>
                <input name="idcompra" class="easyui-validatebox idcompra" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="estado" style="display:inline-block;width:150px;">Estado:</label>
                <input id="cc" class="easyui-combobox estado" name="estado" data-options="valueField:'idcompraestadotipo',textField:'cetdescripcion',url:'<?=base_url('admin/estadotipo/listar')?>'">
            </div>
            <div style="margin-bottom:10px">
                <label for="cetfechainicio" style="display:inline-block;width:150px;">Fecha de Inicio:</label>
                <input class="easyui-datetimebox cetfechainicio" name="cetfechainicio" data-options="showSeconds:false" value="<?=date('d/m/Y H:i');?>" style="width:150px">
            </div>
            <div style="margin-bottom:10px">
                <label for="cetfechafin" style="display:inline-block;width:150px;">Fecha de Fin:</label>
                <input class="easyui-datetimebox cetfechafin" name="cetfechafin" data-options="showSeconds:false" value="01/01/2000 0:0" style="width:150px">
            </div>
        </form>
    </div>
    <div id="dlg-buttons-edit">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <script type="text/javascript">
        var url;
        var action;
        function add(){
            $('#dlg-new').dialog('open').dialog('center').dialog('setTitle','Nuevo Estado de Compra');
            $('#fm-new').form('clear');
            url = "<?php echo base_url('admin/estados/crear')?>";;
            action = "new";
        }
        function edit(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg-edit').dialog('open').dialog('center').dialog('setTitle','Editar Estado de Compra');
                $('#fm-edit').form('load',row);
                url = "<?php echo base_url('admin/estados/editar')?>";
            }
            action = "edit";
        }
        function save(){
            switch(action){
                case "new":
                    $('#fm-new').form('submit',{
                        url: url,
                        iframe: false,
                        onSubmit: function(){
                            return $(this).form('validate');
                        },
                        success: function(result){
                            var result = eval('(' + result + ')');
                            if (!result.success){
                                $.messager.show({
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            } else {
                                $('#dlg-new').dialog('close');       
                                $('#dg').datagrid('reload');    
                            }
                        }
                    });
                    break;
                case "edit":
                    $('#fm-edit').form('submit',{
                        url: url,
                        iframe: false,
                        onSubmit: function(){
                            return $(this).form('validate');
                        },
                        success: function(result){
                            try{
                                var result = eval('(' + result + ')');
                                if (!result.success){
                                    $.messager.show({
                                        title: 'Error',
                                        msg: result.errorMsg
                                    });
                                } else {
                                    $('#dlg-edit').dialog('close');       
                                    $('#dg').datagrid('reload');    
                                }
                            }catch(e){
                                console.log(e);
                            }
                            
                        }
                    });
                    break;

            }
        }
        function destroy(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','¿Esta seguro que quiere eliminar a este estado de compra?',function(r){
                    if (r){
                        $.post('<?php echo base_url('admin/estados/eliminar')?>',{idcompraestado:row.idcompraestado},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');
                            } else {
                                $.messager.show({  
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }

        $.extend($.fn.validatebox.defaults.rules, {
            number: {
                validator: function(value){
                    var regex =  /^[0-9]+$/
                    return regex.test(value);
                },
                message: 'Only numbers are allowed.'
            }
        });
        
        $('.idcompraestado').validatebox({
            required: true,
            validType: ['number']
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="<?=base_url('javascript/funciones.js')?>"></script>
</body>
</html>