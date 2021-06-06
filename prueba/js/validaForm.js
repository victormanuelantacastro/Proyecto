window.onload=iniciarValidacion;

function iniciarValidacion(){
    document.getElementById("registrar").addEventListener('click',validar,false);
}

function validarDni(){
    var elemento = document.getElementById("dni");
    if (!elemento.checkValidity()){
        if(elemento.validity.valueMissing){
            error2(elemento,"Debe introducir un Dni");
        }
        if(elemento.validity.patternMismatch){
            error2(elemento,"El nombre debe tener una estructura de 8 números y una letra");
        }
      //  error(elemento);
        return false;
    }
    return true;
}

function validarNombre(){
    var elemento = document.getElementById("nombre");
    if (!elemento.checkValidity()){
        if(elemento.validity.valueMissing){
            error2(elemento,"Debe introducir un nombre");
        }
        if(elemento.validity.patternMismatch){
            error2(elemento,"El nombre debe tener entre 2 y 15 caracteres");
        }
       // error(elemento);
        return false;
    }
    return true;
}

function validarApellidos(){
    var elemento = document.getElementById("apellidos");
    if (!elemento.checkValidity()){
        if(elemento.validity.valueMissing){
            error2(elemento,"Debe introducir mínimo un apellido");
        }
        if(elemento.validity.patternMismatch){
            error2(elemento,"El apellido debe tener entre 2 y 45 caracteres");
        }
       // error(elemento);
        return false;
    }
    return true;
}

function validarDireccion(){
    var elemento = document.getElementById("direccion");
    if (!elemento.checkValidity()){
        if(elemento.validity.valueMissing){
            error2(elemento,"Debe introducir una dirección");
        }
        if(elemento.validity.patternMismatch){
            error2(elemento,"La direccion debe tener entre 20 y 75 caracteres");
        }
       // error(elemento);
        return false;
    }
    return true;
}

function validarCp(){
    var elemento = document.getElementById("cp");
    if(elemento.validity.valueMissing){
        error2(elemento,"Debe introducir un Codigo Postal");
    }
    if(elemento.validity.patternMismatch){
        error2(elemento,"El codigo postal debe estar formado por 5 números");
    }
    if (!elemento.checkValidity()){
       // error(elemento);
        return false;
    }
    return true;
}

function validarTelefono(){
    var elemento = document.getElementById("telf");
    if (!elemento.checkValidity()){
        if(elemento.validity.valueMissing){
            error2(elemento,"Debe introducir un teléfono");
        }
        if(elemento.validity.patternMismatch){
            error2(elemento,"El teléfono debe tener entre 9 números");
        }
        //error(elemento);
        return false;
    }
    return true;
}

function validarUsuario(){
    var elemento = document.getElementById("login");
    if (!elemento.checkValidity()){
        if(elemento.validity.valueMissing){
            error2(elemento,"Debe introducir un nombre de usuario");
        }
        if(elemento.validity.patternMismatch){
            error2(elemento,"El nombre debe tener entre 5 y 25 caracteres y/o números");
        }
        //error(elemento);
        return false;
    }
    return true;
}

function validarEmail(){
    var elemento = document.getElementById("email");
    if (!elemento.checkValidity()){
        if(elemento.validity.valueMissing){
            error2(elemento,"Debe introducir un email");
        }
        if(elemento.validity.patternMismatch){
            error2(elemento,"El nombre debe tener letras y/o numeros, una @, letras y o números, un punto y de 2 a 4 letras");
        }
        //error(elemento);
        return false;
    }
    return true;
}

function validar(e){
    borrarError();
    if (validarDni() && validarNombre() && validarApellidos() && validarDireccion() && validarCp() && validarTelefono() && 
    validarUsuario() && validarEmail() && confirm("Pulse aceptar si desea confirmar su registro")){
        return true;
    }else{
        e.preventDefault();
        return false;
    }
}

function error (elemento){
    document.getElementById("mensajeError").InnerHTML =elemento.validationMessage;
    elemento.className="error";
    elemento.focus();
}

function borrarError(){
    var formulario = document.forms[0];
    for (var i=0; i<formulario.elements.length;i++){
        formulario.elements[i].className = "";
    }
}

function error2(elemento,mensaje){
    document.getElementById("mensajeError").innerHTML = mensaje;
    elemento.className = "error";
    elemento.focus();

}