
window.onload = function() {
    frm = document.getElementById('contacto');
    frm.onsubmit = function() {return validar(frm);}
}

function validar(frm) {

    frm.btnenviar.disabled = true;

    if (frm.txtnombre.value.length < 1 || frm.txtnombre.value.length > 100) {
        window.alert('Nombre: campo requerido (hasta 100 caracteres).');
        frm.txtnombre.focus();
        frm.btnenviar.disabled = false;
        return false;
    }

    if (frm.txtemail.value.length < 1 || frm.txtemail.value.length > 100) {
        window.alert('E-mail: campo requerido (hasta 100 caracteres).');
        frm.txtemail.focus();
        frm.btnenviar.disabled = false;
        return false;
    }

    if (frm.txtmensaje.value.length < 1 || frm.txtmensaje.value.length > 1000) {
        window.alert('Mensaje: campo requerido (hasta 1000 caracteres).');
        frm.txtmensaje.focus();
        frm.btnenviar.disabled = false;
        return false;
    }

    return true;

}
