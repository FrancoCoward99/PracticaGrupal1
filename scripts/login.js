
// window.onload = function () {
//     // console.log("Inició el programa.");
//     alert("Alerta de inicio de DOM.");
//     // muestraMensaje();
// }

document.addEventListener('DOMContentLoaded', function(){

const form = document.getElementById('loginForm')
const loginError = document.getElementById('loginError')

form.addEventListener('submit', function(e){

e.preventDefault();

const vEmail = document.getElementById("txtEmail").value
const vContrasenna = document.getElementById("txtPassword").value

const correo = 'admin@ufide.ac.cr'
const contrasenna = "Admin123"

if(vEmail === correo && vContrasenna === contrasenna){
    window.location.href = "dashboard.html"
}else{
    loginError.style.display = "block"
}

/**
 * 
 * 2 como string y un 2 como número, ==, true
 * 2 como string y un 2 como número, ===, false
 */


})

})
