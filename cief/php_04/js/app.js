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

    let nombre = document.getElementById("nombre").value.trim();
    const nombreP = parseName(nombre);
    let apellido = document.getElementById("apellidos").value.trim();
    const apellidoP = parseName(apellido);
    let email = document.getElementById("email").value.trim();
    let nif = document.getElementById("nif").value.trim();
    let direccion = document.getElementById("direccion").value.trim();
    let ciudad = document.getElementById("ciudad").value.trim();
    let telefono = document.getElementById("telefono").value.trim();

    
    

    const password1 = document.getElementById("password1").value;
    document.getElementById("password2").value;

    if (password1!== password2) {
        document.getElementById("errorPassword").innerHTML = "<p> Las contraseñas no coinciden </p>";
        password2 = document.getElementById("password2").value;

        return;
    }

    let datos = {
        "nombre": nombreP,
        "apellido": apellidoP,
        "email": email,
        "nif": nif,
        "direccion": direccion,
        "ciudad": ciudad,
        "password": password1,
        "telefono": telefono,
    }
    fetch("../php/signup.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(datos)
    })
        // .then(response => response.json())
        // .then(data => {
        //     console.log(data);
        //     alert("Usuario creado correctamente");
        //     window.location.href = "login.html";
        // })
        // .catch(error => {
        //     console.error(error);
        //     alert("Error al crear el usuario");
        // });
    
    
    // signupForm.reset();
});
const preps = ["de", "del", "el", "la", "los", "las"]

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
