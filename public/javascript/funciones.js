$.validator.addMethod("alphanumeric",function(value,element){
    var regex =  /^[a-zA-Z0-9]+$/
    return regex.test(value);
},"Solo se permiten letras y números");

$(document).ready(function() {
    $('#login').validate({
        rules:{
            usnombre:{
                required: true,
                maxlength: 50,
                alphanumeric: true
            },
            uspass:{
                required: true,
                maxlength: 50,
                minlength: 8,
                alphanumeric: true
            }
        },
        messages:{
            usnombre:{
                required: "El nombre de usuario es obligatorio",
                maxlength: "Máximo 50 caracteres",
            },
            uspass:{
                required: "La contraseña es obligatoria",
                maxlength: "Máximo 50 caracteres",
                minlength: "Mínimo 8 caracteres",
            }
        },
        submitHandler: function(form){
            var contrasenia = $('#uspass').val();
            var hash = CryptoJS.SHA256(contrasenia).toString(CryptoJS.enc.base64);
            $('#uspass').val(hash);
            form.submit();
        },errorPlacement: function(error, element) {
            idElemento = element.attr('id');
            divError = $('#error-' + idElemento);
            error.appendTo(divError);
        }
    });

    $('#registro').validate({
        rules:{
            usnombre:{
                required: true,
                maxlength: 50,
                alphanumeric: true
            },
            uspass:{
                required: true,
                maxlength: 50,
                minlength: 8,
                alphanumeric: true
            },
            usmail:{
                required: true,
                email: true,
                maxlength: 50
            }
        },
        messages:{
            usnombre:{
                required: "El nombre de usuario es obligatorio",
                maxlength: "Máximo 50 caracteres",
            },
            uspass:{
                required: "La contraseña es obligatoria",
                maxlength: "Máximo 50 caracteres",
                minlength: "Mínimo 8 caracteres",
            },
            usmail:{
                required: "El correo electrónico es obligatorio",
                email: "Ingrese un correo electrónico válido",
                maxlength: "Máximo 50 caracteres"
            }
        },
        submitHandler: function(form){
            var contrasenia = $('#uspass').val();
            var hash = CryptoJS.SHA256(contrasenia).toString(CryptoJS.enc.base64);
            $('#uspass').val(hash);
            form.submit();
        },errorPlacement: function(error, element) {
            idElemento = element.attr('id');
            divError = $('#error-' + idElemento);
            error.appendTo(divError);
        }
    });

});