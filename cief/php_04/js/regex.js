//Expresiones regulares

const nombre = "Hola";

const patern = /^[a-zA-záéíóúàèìòùñÑçÇÁÉÍÓÚÙÒÌÈÀ\s]+$/;

console.log(nombre.match(patern));
console.log(nombre.search(patern));
console.log(nombre.replace(patern, "A"));
console.log(patern.test(nombre));


