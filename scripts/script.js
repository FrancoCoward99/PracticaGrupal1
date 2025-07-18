
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('register-form')
    const registerError = document.getElementById('register-error')

    form.addEventListener('submit', function (e) {

        e.preventDefault();

        const nombre = document.getElementById("nombre").value
        const vContra1 = document.getElementById("password").value
        const vContra2 = document.getElementById("confirmPassword").value

        if (vContra1 !== vContra2) {
            //No coinciden 
            registerError.innerHTML = `<div class="alert alert-danger fade show" role="alert">
                Error: <strong>Las contraseñas no coinciden.</strong>
              </div>`
        } else {
            //Si coincide

            const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

            console.log(regex.test(vContra1));

            if (regex.test(vContra1)) {

                registerError.innerHTML = `<div class="alert alert-success fade show" role="alert">
                Éxito: <strong>El registro se realizó exitosamente. Bienvenido/a, ${nombre} </strong>
              </div>`

                setTimeout(() => {
                    registerError.innerHTML = "";
                    window.location.href = "dashboard.html"
                }, 5000);
            } else {
                registerError.innerHTML = `<div class="alert alert-danger fade show" role="alert">
                Error: <strong>La contraseña no cumple con el formato mínimo requerido.</strong>
              </div>`
            }

        }

    })
})



let vGlobal = 2.3452

function muestraMensaje() {
    // alert("Mensaje llamado con la función 1.");

    let vLocal = 2;
}

const muestraMensajeFlecha = (pNombre, pApellido) => {
    alert("Mensaje llamado con la función flecha.");

    //Definición de variables
    var nombreUsuario = "Joshua"
    let apellidoUsuario = "Loría"
    const edadUsuario = 15

    //Tipos de datos, propiedades
    console.log("Hola " + pNombre + " " + pApellido + ", su edad es " + edadUsuario + " años. La variable global es: " + vGlobal);
    console.log("Su nombre tiene: " + pNombre.length + " letras");
    console.log("charAt: " + pNombre.charAt(2));
    console.log("endsWith: " + pNombre.endsWith("ana"));
    console.log("replace: " + pNombre.replace("a", ""));
    console.log("replace global: " + pNombre.replace(/a/g, ""));
    console.log("substr: " + pNombre.substr(2));

    if (isNaN(vGlobal)) {
        console.log("No es un número");
    } else {
        console.log("Si es un número.");
    }

    console.log("El número con dos decimales es: " + vGlobal.toFixed(2));
    console.log("El número string es: " + vGlobal.toString());

    //Condicional ternario
    const vAux = vGlobal == 2.3452 ? "El número es 3" : "El número no es 3"
    console.log(vAux)

    console.log("-------------------------------");

    //Switch
    let vNombre = "Azul"
    switch (vNombre) {
        case "Amarillo":
            console.log("precaución.")
            break;

        case "Verde":
            console.log('Avance');
            break;

        case "Rojo":
            console.log('Alto');
            break;

        default:
            console.log('No se identificó el valor ingresado.');
            break;
    }
    console.log("-------------------------------");
    //For(ciclos)


    let vArray = [1, 2, 3, 4, 5, 6]
    for (let x in vArray) {
        console.log(vArray[x]);
    }

    console.log("Inicia");
    //Pendiente
    // for(let i = 0; i > 5; x++){
    //     console.log(i);
    // }

    for (let i = 0; i < 5; i++) {
        console.log(i);
    }

}

const validaFormulario = () => {


    const cNombreUsuario = document.getElementById("nombre").value

    if (cNombreUsuario.length < 1) {
        alert("Debe ingresar un nombre.")
    } else if (cNombreUsuario.length > 5) {
        alert("El nombre no debe contener más de 5 caracteres.");
    }

    console.log(cNombreUsuario);


}