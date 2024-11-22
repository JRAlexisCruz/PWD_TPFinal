<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administracion de Menu</title>
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
    <table id="dg" title="Menu" class="easyui-datagrid" style="width:95%;height:250px"
            url="<?=base_url('admin/menus/listar')?>"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true" method="get">
        <thead>
            <tr>
                <th field="idmenu" width="20">ID</th>
                <th field="menombre" width="60">Nombre</th>
                <th field="medescripcion" width="70">Descripcion</th>
                <th field="script" width="50">Script</th>
                <th field="roles" width="50">Roles</th>
                <th field="medeshabilitado" width="50">Fecha Deshabilitado</th>
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
            <h3>Informacion del Menu</h3>
            <div style="margin-bottom:10px">
                <label for="menombre" style="display:inline-block;width:150px;">Nombre del menu:</label>
                <input name="menombre" class="easyui-validatebox menombre" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="medescripcion" style="display:inline-block;width:150px;">Descripcion:</label>
                <input name="medescripcion" class="easyui-validatebox medescripcion" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="script" style="display:inline-block;width:150px;">Script</label>
                <input name="script" class="easyui-validatebox script" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="roles[]" style="display:inline-block;width:150px;">Roles:</label>
                <br>
                <div id="checkboxes-new">

                </div>
            </div>
        </form>
    </div>
    <div id="dlg-buttons-new">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-new').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <div id="dlg-edit" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-edit'">
        <form id="fm-edit" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion del Menu</h3>
            <div style="margin-bottom:10px">
                <label for="idmenu" style="display:inline-block;width:150px;">ID:</label>
                <input name="idmenu" class="easyui-validatebox idmenu" style="width:100%" readonly>
            </div>
            <div style="margin-bottom:10px">
                <label for="menombre" style="display:inline-block;width:150px;">Nombre del menu:</label>
                <input name="menombre" class="easyui-validatebox menombre" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="medescripcion" style="display:inline-block;width:150px;">Descripcion:</label>
                <input name="medescripcion" class="easyui-validatebox medescripcion" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="script" style="display:inline-block;width:150px;">Menu Padre:</label>
                <input name="script" class="easyui-validatebox script" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="roles[]" style="display:inline-block;width:150px;">Roles:</label>
                <br>
                <div id="checkboxes-edit">

                </div>
            </div>
        </form>
    </div>
    <div id="dlg-buttons-edit">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close'); $('#checkboxes-new').empty(); $('#checkboxes-edit').empty()" style="width:90px">Cancelar</a>
    </div>

    <script type="text/javascript">
        var url;
        var action;
        function add(){
            $.ajax({
                url: '<?=base_url('admin/roles/listar')?>', 
                method: 'GET',
                success: function(data) {
                    var row = $('#dg').datagrid('getSelected');
                    data = JSON.parse(data);
                    data.forEach(function(rol){
                        var checkboxHtml = `<input class="easyui-checkbox" type="checkbox" name="roles[]" value="${rol.idrol}"> ${rol.rodescripcion} <br>`;
                        $('#checkboxes-new').append(checkboxHtml);    
                    });
                }
            });
            $('#dlg-new').dialog('open').dialog('center').dialog('setTitle','Nuevo Menu');
            $('#fm-new').form('clear');
            url = "<?php echo base_url('admin/menus/crear')?>";;
            action = "new";
        }
        function edit(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.ajax({
                    url: '<?=base_url('admin/roles/listar')?>', 
                    method: 'GET',
                    success: function(data) {
                        var row = $('#dg').datagrid('getSelected');
                        data = JSON.parse(data);
                        data.forEach(function(rol){
                            if(row.roles.includes(rol.rodescripcion)){
                                var checkboxHtml = `<input class="easyui-checkbox" type="checkbox" name="roles[]" value="${rol.idrol}" checked> ${rol.rodescripcion} <br>`;
                            }else{
                                var checkboxHtml = `<input class="easyui-checkbox" type="checkbox" name="roles[]" value="${rol.idrol}"> ${rol.rodescripcion} <br>`;
                            }
                            $('#checkboxes-edit').append(checkboxHtml);    
                        });
                    }
                });
                $('#dlg-edit').dialog('open').dialog('center').dialog('setTitle','Editar Menu');
                $('#fm-edit').form('load',row);
                url = "<?php echo base_url('admin/menus/editar')?>";
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
                    $('#checkboxes-new').empty();
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
                    $('#checkboxes-edit').empty();
                    break;
            }
        }
        function destroy(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','¿Estas seguro que quieres eliminar este menu?',function(r){
                    if (r){
                        $.post('<?php echo base_url('admin/menus/eliminar')?>',{idmenu:row.idmenu},function(result){
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

        $('.menombre').validatebox({
            required: true,
            validType: ['length[1,100]']
        });

        $('.medescripcion').validatebox({
            required: true,
            validType: ['length[1,124]']
        });

        $('.idmenu').validatebox({
            required: true,
            validType: ['number']
        });

        $('.script').validatebox({
            required: true,
            validType: ['length[1,50]']
        });
    </script>
    <script src="<?=base_url('javascript/funciones.js')?>"></script>
    <?= view('estructura/footer'); ?>
    <script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>