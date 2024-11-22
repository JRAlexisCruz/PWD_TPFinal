<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administracion de Usuarios</title>
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
<body style="padding:0"> 
    <?= view('estructura/header'); ?>
    <table id="dg" title="Usuarios" class="easyui-datagrid" style="width:95%;height:250px"
            url="<?=base_url('admin/usuarios/listar')?>"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true" method="get">
        <thead>
            <tr>
                <th field="idusuario">ID</th>
                <th field="usnombre">Nombre de Usuario</th>
                <th field="uspass">Contraseña</th>
                <th field="usmail">Email</th>
                <th field="roles">Roles</th>
                <th field="usdeshabilitado">Fecha Deshabilitado</th>
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
            <h3>Informacion del Usuario</h3>
            <div style="margin-bottom:10px">
                <label for="usnombre" style="display:inline-block;width:150px;">Nombre de usuario:</label>
                <input name="usnombre" class="easyui-validatebox usnombre" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="contrasenia" style="display:inline-block;width:150px;">Contraseña:</label>
                <input name="contrasenia" class="easyui-validatebox contrasenia" style="width:100%" id="contrasenia">
            </div>
            <div style="margin-bottom:10px">
                <label for="usmail" style="display:inline-block;width:150px;">Email:</label>
                <input name="usmail" class="easyui-validatebox usmail" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="roles[]" style="display:inline-block;width:150px;">Roles:</label>
                <br>
                <label for=""><input type="checkbox" name="roles[]" id="admin" value="3">Usuario</label>
                <br>
                <label for=""><input type="checkbox" name="roles[]" id="admin" value="2">Desposito</label>
                <br>
                <label for=""><input type="checkbox" name="roles[]" id="admin" value="1">Administrador</label>
                <br>
            </div>
        </form>
    </div>
    <div id="dlg-buttons-new">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-new').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <div id="dlg-edit" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-edit'">
        <form id="fm-edit" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion del Usuario</h3>
            <div style="margin-bottom:10px">
                <label for="idusuario" style="display:inline-block;width:150px;">ID:</label>
                <input name="idusuario" class="easyui-validatebox idusuario" style="width:100%" readonly>
            </div>
            <div style="margin-bottom:10px">
                <label for="usnombre" style="display:inline-block;width:150px;">Nombre:</label>
                <input name="usnombre" class="easyui-validatebox usnombre" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="uspass" style="display:inline-block;width:150px;">Contraseña:</label>
                <input name="uspass" class="easyui-validatebox" style="width:100%" readonly>
            </div>
            <div style="margin-bottom:10px">
                <label for="usmail" style="display:inline-block;width:150px;">Email:</label>
                <input name="usmail" class="easyui-validatebox" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="roles[]" style="display:inline-block;width:150px;">Roles:</label>
                <br>
                <div id="checkboxes">

                </div>
            </div>
        </form>
    </div>
    <div id="dlg-buttons-edit">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close');$('#checkboxes').empty();" style="width:90px">Cancelar</a>
    </div>

    <script type="text/javascript">
        var url;
        var action;
        function add(){
            $('#dlg-new').dialog('open').dialog('center').dialog('setTitle','Nuevo Usuario');
            $('#fm-new').form('clear');
            url = "<?php echo base_url('admin/usuarios/crear')?>";;
            action = "new";
        }
        function edit(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                if(row.usdeshabilitado != null){
                    $.messager.show({  
                        title: 'Error',
                        msg: 'No se puede editar un usuario deshabilitado'
                    });
                }else{
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
                                $('#checkboxes').append(checkboxHtml);    
                            });
                        }
                    });
                    $('#dlg-edit').dialog('open').dialog('center').dialog('setTitle','Editar Usuario');
                    $('#fm-edit').form('load',row);
                    url = "<?php echo base_url('admin/usuarios/editar')?>";
                }
                
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
                            $valido=$(this).form('validate');
                            if($valido){
                                var contrasenia = $('#contrasenia').val();
                                var hash = CryptoJS.SHA256(contrasenia).toString(CryptoJS.enc.base64);
                                $('#fm-new').append('<input type="hidden" name="uspass" value="' + hash + '" />');
                                $('#contrasenia').val('');
                            }
                            return $valido;
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
                        }
                    });
                    $('#checkboxes').empty();
                    break;

            }
        }
        function destroy(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                if(row.usdeshabilitado != null){
                    $.messager.show({  
                        title: 'Error',
                        msg: 'No se puede eliminar un usuario deshabilitado'
                });
                }else{
                    $.messager.confirm('Confirmar','¿Esta seguro que quiere eliminar a este usuario?',function(r){
                        if (r){
                            $.post('<?php echo base_url('admin/usuarios/eliminar')?>',{id:row.idusuario},function(result){
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
        }

        $.extend($.fn.validatebox.defaults.rules, {
            alphanumeric: {
                validator: function(value){
                    var regex =  /^[a-zA-Z0-9]+$/
                    return regex.test(value);
                },
                message: 'Only letters and numbers are allowed.'
            }
        });

        $.extend($.fn.validatebox.defaults.rules, {
            number: {
                validator: function(value){
                    var regex =  /^[0-9]+$/
                    return regex.test(value);
                },
                message: 'Only numbers are allowed.'
            }
        });

        $('.idusuario').validatebox({
            required: true,
            validType: ['number']
        });

        $('.usnombre').validatebox({
            required: true,
            validType: ['length[1,50]','alphanumeric']
        });

        $('.contrasenia').validatebox({
            required: true,
            validType: ['length[8,50]','alphanumeric']
        });

        $('.usmail').validatebox({
            required: true,
            validType: ['email','length[1,50]']
        });

    </script>
    <?= view('estructura/footer'); ?>
    <script src="<?= base_url('javascript/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>