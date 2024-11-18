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
</head>
<body>
    <h2>Edit form in expanded row details</h2>
    <p>Click the expand button to expand a detail form.</p>

    <table id="dg" title="Usuarios" class="easyui-datagrid" style="width:1000px;height:250px"
            url="<?=base_url('admin/usuarios/listar')?>"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true" method="get">
        <thead>
            <tr>
                <th field="idusuario" width="50">ID</th>
                <th field="usnombre" width="50">Nombre de Usuario</th>
                <th field="uspass" width="50">Contraseña</th>
                <th field="usmail" width="50">Email</th>
                <th field="usdeshabilitado" width="50">Fecha Deshabilitado</th>
            </tr>
        </thead>
    </table>

    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove User</a>
    </div>
    
    <div id="dlg-new" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-new'">
        <form id="fm-new" method="post" style="margin:0;padding:20px 50px">
            <h3>Informacion del Usuario</h3>
            <div style="margin-bottom:10px">
                <label for="usnombre" style="display:inline-block;width:150px;">Nombre de usuario:</label>
                <input name="usnombre" class="easyui-validatebox" style="width:100%" id="usnombre">
            </div>
            <div style="margin-bottom:10px">
                <label for="contrasenia" style="display:inline-block;width:150px;">Contraseña:</label>
                <input name="contrasenia" class="easyui-validatebox" style="width:100%" id="contrasenia">
            </div>
            <div style="margin-bottom:10px">
                <label for="usmail" style="display:inline-block;width:150px;">Email:</label>
                <input name="usmail" class="easyui-validatebox" style="width:100%" id="usmail">
            </div>
        </form>
    </div>
    <div id="dlg-buttons-new">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-new').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="dlg-edit" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-edit'">
        <form id="fm-edit" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informacion del Usuario</h3>
            <div style="margin-bottom:10px">
                <label for="idusuario" style="display:inline-block;width:150px;">ID:</label>
                <input name="idusuario" class="easyui-validatebox" style="width:100%" readonly>
            </div>
            <div style="margin-bottom:10px">
                <label for="usnombre" style="display:inline-block;width:150px;">Nombre de usuario:</label>
                <input name="usnombre" class="easyui-validatebox" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <label for="uspass" style="display:inline-block;width:150px;">Contraseña:</label>
                <input name="uspass" class="easyui-validatebox" style="width:100%" readonly>
            </div>
            <div style="margin-bottom:10px">
                <label for="usmail" style="display:inline-block;width:150px;">Email:</label>
                <input name="usmail" class="easyui-validatebox" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg-buttons-edit">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-edit').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <script type="text/javascript">
        var url;
        var action;
        function newUser(){
            $('#dlg-new').dialog('open').dialog('center').dialog('setTitle','Nuevo User');
            $('#fm-new').form('clear');
            url = "<?php echo base_url('admin/usuarios/crear')?>";;
            action = "new";
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg-edit').dialog('open').dialog('center').dialog('setTitle','Editar Usuario');
                $('#fm-edit').form('load',row);
                url = "<?php echo base_url('admin/usuarios/editar')?>";
            }
            action = "edit";
        }
        function saveUser(){
            switch(action){
                case "new":
                    $('#fm-new').form('submit',{
                        url: url,
                        iframe: false,
                        onSubmit: function(){
                            var contrasenia = $('#contrasenia').val();
                            var hash = CryptoJS.SHA256(contrasenia).toString(CryptoJS.enc.base64);
                            $('#fm-new').append('<input type="hidden" name="uspass" value="' + hash + '" />');
                            $('#contrasenia').val('xxxxxxxx');
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
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
                    if (r){
                        $.post('<?php echo base_url('admin/usuarios/eliminar')?>',{id:row.idusuario},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
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
            alphanumeric: {
                validator: function(value){
                    var regex =  /^[a-zA-Z0-9]+$/
                    return regex.test(value);
                },
                message: 'Only letters and numbers are allowed.'
            }
        });

        $('#usnombre').validatebox({
            required: true,
            validType: ['length[1,50]','alphanumeric']
        });

        $('#contrasenia').validatebox({
            required: true,
            validType: ['length[8,50]','alphanumeric']
        });

        $('#usmail').validatebox({
            required: true,
            validType: ['email','length[1,50]']
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
    <script src="<?=base_url('javascript/funciones.js')?>"></script>
</body>
</html>