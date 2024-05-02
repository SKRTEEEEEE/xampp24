// Ocultar formulario de alta 
document.getElementById("signup").style.display = "none";

function mostrarFormularioAlta() {
    document.getElementById("signin").style.display = "none";
    document.getElementById("signup").style.display = "block";
}

function volverInicio() {
    document.getElementById("signin").style.display = "block";
    document.getElementById("signup").style.display = "none";
}

const signupForm = document.getElementById("signupForm");

signupForm.addEventListener("submit", (e) => {
    e.preventDefault();
  
    //Obtener datos del formulario
    const formData = new FormData(signupForm);
    //Obtener cada valor
    const nombre = parseName(formData.get("nombre").trim());
    const apellidos = parseName(formData.get("apellidos").trim());
    const password1 = formData.get("password1");
    const password2 = formData.get("password2");
    let password;
    const email = formData.get("email");
    const nif = formData.get("nif").toUpperCase().trim();
    const telefono = formData.get("telefono").trim();
    const direccion = formData.get("direccion").trim();
    const ciudad = formData.get("ciudad").trim();
    const paternNotNumbers = /^[a-zA-záéíóúàèìòùñÑçÇÁÉÍÓÚÙÒÌÈÀ'\s]+$/;
    const paternNif = /[0-9A-Z][0-9]{7}[0-9]/;
    const paternTel = /[0-9]{9}/
    const paternDireccion = /^[a-zA-záéíóúàèìòùñÑçÇÁÉÍÓÚÙÒÌÈÀ0-9'\s,-\/ºª]+$/
    let stopProcess = false;
    if(!validarItems("nombre",nombre, paternNotNumbers)){
        stopProcess = true ;
    }
    if(!validarItems("apellidos",apellidos, paternNotNumbers)){
        stopProcess = true ;
    };
    if (password1 !== password2) {
        document.getElementById("error-password").innerHTML = "<p> Las contraseñas no coinciden </p>";
        password = password1;
        stopProcess = true;
    }
    if(nif.length < 9){
        document.getElementById("error-nif").innerHTML = "<p> El NIF es mas pequeño de 9 </p>";
        document.getElementById(`error-nif`).style.backgroundColor = "red";
        stopProcess = true;
    } else if(nif.length > 9){
        document.getElementById("error-nif").innerHTML = "<p> El NIF es mas grande de 9 </p>";
        document.getElementById(`error-nif`).style.backgroundColor = "red";
        stopProcess = true;}
    // } else {
    //     if(!validarItems("nif", nif, paternNif)) { (document.getElementById("error-nif").innerHTML = "<p> Patron valido </p>")}else{stopProcess=true};
    // }
    if(!validarItems("telefono", telefono, paternTel)){
        stopProcess = true ;
    }
    if(!validarItems("direccion", direccion, paternDireccion)){
        stopProcess = true ;
    }
    if(!validarItems("ciudad", ciudad, paternNotNumbers)){
        stopProcess = true ;
    }
    if(stopProcess){
        return;
    }

    let data = {
        nombre, apellidos, password, email, nif, telefono, direccion, ciudad
    }
    

    //Enviar el objeto con los datos, el fetch() se ejecuta desde la raíz.
    fetch("php/signup.php", {
        method: "POST",
        //Le indicamos que el body va ( "plano/ en string" ) en JSON string
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
        .then(response => response.text())
        .then(() => {
            // console.log("res :", data);
            alert("Usuario creado correctamente");
            location.href = "php/ecommerce.php";
        })
        .catch(error => {
            console.error(error);
            // alert("Error al crear el usuario");
        });

    
    signupForm.reset();
});
const preps = ["de", "del", "el", "la", "los", "las"];

function validarItems(lit, texto, patern){
    if (patern.test(texto)) {
        console.log(lit, " correcto");
        return true;
     } else {
         console.log(lit, " incorrecto");
         document.getElementById(`error-${lit}`).innerHTML = `<p> El ${lit} no es correcto </p>`;
         document.getElementById(`error-${lit}`).style.backgroundColor = "red";
         return false;
     }
}

function parseName(nombre) {
    const names = nombre.split(" ");
    let respuestaNombre = "";

    names.forEach(name => {
        name = name.toLowerCase();

        // Capitalizar la primera letra de cada parte del nombre, excepto preposiciones
        if (!preps.includes(name)) {
            let string = name.charAt(0).toUpperCase() + name.slice(1);
            respuestaNombre += string;
        } else {
            respuestaNombre += name; // Mantener preposiciones en minúsculas
        }

        respuestaNombre += " "; // Agregar un espacio después de cada parte del nombre
    });

    return respuestaNombre.trim(); // Eliminar espacios adicionales al final y al inicio
}
