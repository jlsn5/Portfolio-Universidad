//Para sacar el id que queremos acceder
function $(id) {
    return document.getElementById(id);
}

// ************ FUNCION PARA VALIDAR FORMULARIO LOGIN ************
// .trim sirver para eliminar espacios en blanco por delante y detras del texto
function validaLogin(event) {
    var ok = true;
    var msg = 'Debes escribir algo en los campos:\n';
    if ($('user').value.trim() == '') {
        msg += '- User\n';
        ok = false;
    }

    if ($('password').value.trim() == '') {
        msg += '- Password\n';
        ok = false;
    }
    if (ok == false) {
        alert(msg);
        event.preventDefault();
    } else
        alert('Todo correcto, se envía el formulario');
}

// function load() {
//     $('login').addEventListener('submit', validaLogin);
// }
// document.addEventListener('DOMContentLoaded', load, false);



// ************ FUNCION PARA VALIDAR FORMULARIO REGISTRO ************
function validaRegistro(event) {
    var ok = true;
    var arroba = /[@]/;
    var numeros = /^[0-9]+$/;
    var letrascontrasena = /^[a-zA-Z0-9\_\-]{4,16}$/;
    var letrasemail = /^[a-zA-Z0-9\_\-\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}~\.]/;
    var letrasUsuario = /[A-Za-z0-9]/;
    var mayus = /[A-Z]/;
    var minus = /[a-z]/;
    var num = /[0-9]/;
    var numArray = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    var msg = 'Debes escribir algo en los campos:\n';
    var mayusCheck = false,
        minusCheck = false,
        numCheck = false;

    //USUARIO

    //Usuario, mayor que 3 y menor que 15 caractere
    if ($('user').value.length < 3 || $('user').value.length > 15) {
        msg += '- Usuario, debe ser mayor que 3 y menor que 15 carateres\n';
        ok = false;
    }

    //Usuario, no puede empezar con numero
    if ($("user").value.charAt(0).match(numeros)) {
        msg += '- Usuario, no puede empezar con un numero\n';
        ok = false;
    }

    //Usuario, tiene que tener alfabeto ingles y numeros
    for (let i = 0; i < $('user').value.length; i++) {
        if (!$("user").value.charAt(i).match(letrasUsuario)) {
            msg += '- Usuario, carácter no permitido\n';
            ok = false;
        }
    }
    // if (!$("user").value.match(letrasUsuario)) {
    //     msg += '- Usuario, carácter no permitido\n';
    //     ok = false;
    // }

    //CONTRASEÑA

    //Contraseña, mayor que 6 y menor que 15
    if ($('password').value.length < 6 || $('password').value.length > 15) {
        msg += '- Contraseña, debe ser mayor que 6 y menor que 15 carateres\n';
        ok = false;
    }

    //Contraseña, tiene que tener alfabeto ingles y numeros
    if (!$('password').value.match(letrascontrasena)) {
        msg += '- Contraseña, carácter no permitido\n';
        ok = false;
    }

    //Contraseña, con al menos una mayuscula, una minuscula y un numero
    for (let i = 0; i < $('password').value.length; i++) {
        if ($('password').value.charAt(i).match(mayus)) {
            mayusCheck = true;
        }
    }

    for (let i = 0; i < $('password').value.length; i++) {
        if ($('password').value.charAt(i).match(minus)) {
            minusCheck = true;
        }
    }

    for (let i = 0; i < $('password').value.length; i++) {
        if ($('password').value.charAt(i).match(num)) {
            numCheck = true;
        }
    }

    if (mayusCheck == false) {
        msg += '- Contraseña, falta mínimo una letra mayúscula\n';
        ok = false;
    }

    if (minusCheck == false) {
        msg += '- Contraseña, falta mínimo una letra minúscula\n';
        ok = false;
    }

    if (numCheck == false) {
        msg += '- Contraseña, falta mínimo un número\n';
        ok = false;
    }


    // REPETIR CONTRASEÑA
    if ($('password2').value != $('password').value) {
        msg += '- Contraseña, Las contraseñas no coinciden\n';
        ok = false;
    }

    // EMAIL

    //email, no puede estar vacío
    if ($('email').value == '') {
        msg += '- Email, Email no puede estar vacío\n';
        ok = false;
    }

    //email, debe tener arroba
    var aux = $('email').value;
    var band = false;
    for (let i = 0; i < $('email').value.length; i++) {
        if (aux.charAt(i) == '@') {
            band = true;
        }
    }
    if (band == false) {
        msg += '- Email, Email no contiene arroba\n';
        ok = false;
    }

    //Separa cadena de email para hacer comprobaciones
    var separado = $('email').value.split('@');
    var partelocal = separado[0];
    var dominio = separado[1];

    //email, partelocal 
    //email, partelocal, longitud maxima 64 caracteres, longitud minima de 1 caracter
    if (partelocal.length < 1 || partelocal.length > 64) {
        msg += '- Email, La parte local debe estar entre 1 y 64 caracteres\n';
        ok = false;
    }

    //email, partelocal, solo alfabeto ingles, números y !#$%&'*+-/=?^_`{|}~
    for (let i = 0; i < partelocal.length; i++) {
        if (!partelocal.charAt(i).match(letrasemail)) {
            msg += '- Email parte local, carácter no permitido\n';
            ok = false;
        }

    }
    // if (!partelocal.match(letrasemail)) {
    //     msg += '- Email parte local, carácter no permitido\n';
    //     ok = false;
    // }

    //email, partelocal, punto no puede aparecer ni al principio ni al final
    if (partelocal.charAt(0) == '.' || partelocal.charAt(partelocal.length - 1) == '.') {
        msg += '- Email parte local, no puede haber un punto al principio ni al final de la parte local\n';
        ok = false;
    }

    //email, partelocal, que hayan 2 puntos seguidos
    for (let i = 0; i <= partelocal.length; i++) {
        for (let j = i + 1; j <= partelocal.length; j++) {
            if (partelocal.charAt(j) == '.' && partelocal.charAt(i) == '.') {
                msg += '- Email parte local, no pueden haber dos puntos seguidos\n';
                ok = false;
            }
        }
    }

    //email, dominio
    //longitud maxima 255 caracteres, longitud minima de 1 caracter
    if (dominio != null && (dominio.length < 1 || dominio.length > 190)) {
        msg += '- Email, el dominio debe estar entre 1 y 190 caracteres\n';
        ok = false;
    }

    //dominio y subdominios
    if (dominio != null) {
        var subdominios = dominio.split('.');

        for (let i = 0; i < subdominios.length; i++) {
            if (subdominios[i] != null) {
                console.log(subdominios.length);
                console.log(subdominios[i]);
                if (subdominios[i].length > 33) {
                    msg += '- Email, el subdominio tiene que ser menor de 63 caracteres\n';
                    ok = false;
                }

                if (!subdominios[i].match(letrasUsuario)) {
                    msg += '- Email, el subdominio tiene un caracter no aceptado\n';
                    ok = false;
                }

                if (subdominios[i].charAt(0) == '-' || subdominios[i].charAt(subdominios[i].length - 1) == '-') {
                    msg += '- Email subdominio, no puede haber un guion al principio ni al final del subdominio\n';
                    ok = false;
                }
            }
        }
    }

    //SEXO

    //sexo, comprobar que al menos una opción está marcada
    if (!document.querySelector('input[name="sexo"]:checked')) {
        msg += '- Sexo, debes seleccionar una de las opciones\n';
        ok = false;
    }

    //FECHA

    //fecha, comprobar que es una fecha válida
    // let isValidDate = Date.parse($('fecha').value);

    // if (isNaN(isValidDate)) {
    //     msg += "- Fecha, el formato de la fecha no es correcto (dd/mm/aa) \n";
    //     ok = false;
    // }

    var fecha = $('fecha').value.split('/');


    if (esFecha($('fecha').value) == false) {
        msg += "- Fecha, el formato de la fecha no es correcto (dd/mm/aa) \n";
        ok = false;
    }

    //Comprobación final
    if (ok == false) {
        alert(msg);
        event.preventDefault();
    } else
        alert('Todo correcto, se envía el formulario');
}

// ************ FUNCION PARA CREAR LA TABLA ************

function tablaPrecios() {
    console.log("Estoy en la función tablaPrecios");

    var d = document.getElementById("tablaCalculada");
    var tabla = document.createElement("table");
    tabla.id = 'tablaPrecios';
    var titulo = document.createElement("caption");
    var cont = 1;
    var cont2 = 3;
    var menor5 = 0.1;
    var entre5y11 = 0.08;
    var mas11 = 0.07;
    var color = 0.05;
    var mas300dpi = 0.02;
    var numPag = 1;
    var numPag2 = 1;
    var numPag3 = 1;
    var numPag4 = 1;
    var numFoto = 3;
    var numFoto2 = 3;
    var numFoto3 = 3;

    titulo.textContent = 'Posibles costes de un álbum';
    tabla.appendChild(titulo);

    for (f = 0; f < 2; f++) {
        var fila = document.createElement("tr");
        for (c = 0; c < 6; c++) {
            var celda = document.createElement("td");
            // celda.textContent = Math.random().toFixed(2);

            if (f == 0 && c == 2) {
                celda.textContent = 'Blanco y negro';
            }

            if (f == 0 && c == 4) {
                celda.textContent = "Color";
            }

            if (f == 1 && c == 0) {
                celda.textContent = "Número de páginas";
            }

            if (f == 1 && c == 1) {
                celda.textContent = "Número de fotos";
            }

            if (f == 1 && c == 2) {
                celda.textContent = "150-300 dpi";
            }

            if (f == 1 && c == 3) {
                celda.textContent = "450-900 dpi";
            }

            if (f == 1 && c == 4) {
                celda.textContent = "150-300 dpi";
            }

            if (f == 1 && c == 5) {
                celda.textContent = "450-900 dpi";
            }

            fila.appendChild(celda);
        }
        tabla.appendChild(fila);
    }

    for (f = 2; f < 17; f++) {
        var fila = document.createElement("tr");
        for (c = 0; c < 6; c++) {
            var celda = document.createElement("td");

            if (c < 1) {
                celda.textContent = cont;
                cont++;
            }

            if (c == 1) {
                celda.textContent = cont2;
                cont2++;
                cont2++;
                cont2++;
            }

            //Blanco y negro
            if (c == 2 && f < 6) {
                //var numPag = document.getElementById("tablaPrecios").rows[f].cells[c].innerText;
                let socorro = menor5 * numPag;
                let socorro2 = socorro.toFixed(2);
                celda.textContent = socorro2;

                numPag++;
            }

            if (c == 2 && f >= 6 && f < 13) {
                let socorro = menor5 * 4 + entre5y11 * (numPag - 4);
                let socorro2 = socorro.toFixed(2);
                celda.textContent = socorro2;
                numPag++;
            }

            if (c == 2 && f >= 13) {
                celda.textContent = (menor5 * 4 + entre5y11 * 7 + mas11 * (numPag - 11)).toFixed(2);;
                numPag++;
            }

            //Blanco y negro, +300 dpi
            if (c == 3 && f < 6) {
                //var numPag = document.getElementById("tablaPrecios").rows[f].cells[c].innerText;
                let socorro = (menor5 * numPag2) + (mas300dpi * numFoto);
                let socorro2 = socorro.toFixed(2);
                celda.textContent = socorro2;

                numPag2++;
                numFoto++;
                numFoto++;
                numFoto++;
            }

            if (c == 3 && f >= 6 && f < 13) {
                let socorro = menor5 * 4 + entre5y11 * (numPag2 - 4) + (mas300dpi * numFoto);
                let socorro2 = socorro.toFixed(2);
                celda.textContent = socorro2;
                numPag2++;
                numFoto++;
                numFoto++;
                numFoto++;
            }

            if (c == 3 && f >= 13) {
                let socorro = menor5 * 4 + entre5y11 * 7 + mas11 * (numPag2 - 11) + (mas300dpi * numFoto);
                let socorro2 = socorro.toFixed(2);
                celda.textContent = socorro2;
                numPag2++;
                numFoto++;
                numFoto++;
                numFoto++;
            }

            //Color
            if (c == 4 && f < 6) {
                let socorro = (menor5 * numPag3) + (color * numFoto2);
                let socorro2 = socorro.toFixed(2);

                celda.textContent = socorro2;

                numPag3++;
                numFoto2++;
                numFoto2++;
                numFoto2++;
            }

            if (c == 4 && f >= 6 && f < 13) {
                celda.textContent = (menor5 * 4 + entre5y11 * (numPag3 - 4) + (color * numFoto2)).toFixed(2);;
                numPag3++;
                numFoto2++;
                numFoto2++;
                numFoto2++;
            }

            if (c == 4 && f >= 13) {
                celda.textContent = (menor5 * 4 + entre5y11 * 7 + mas11 * (numPag3 - 11) + (color * numFoto2)).toFixed(2);;
                numPag3++;
                numFoto2++;
                numFoto2++;
                numFoto2++;
            }

            //Color, +300 dpi
            if (c == 5 && f < 6) {
                //var numPag = document.getElementById("tablaPrecios").rows[f].cells[c].innerText;

                celda.textContent = (menor5 * numPag4 + color * numFoto3 + mas300dpi * numFoto3).toFixed(2);;

                numPag4++;
                numFoto3++;
                numFoto3++;
                numFoto3++;
            }

            if (c == 5 && f >= 6 && f < 13) {
                celda.textContent = (menor5 * 4 + entre5y11 * (numPag4 - 4) + color * numFoto3 + mas300dpi * numFoto3).toFixed(2);;
                numPag4++;
                numFoto3++;
                numFoto3++;
                numFoto3++;
            }

            if (c == 5 && f >= 13) {
                celda.textContent = (menor5 * 4 + entre5y11 * 7 + mas11 * (numPag4 - 11) + color * numFoto3 + mas300dpi * numFoto3).toFixed(2);;
                numPag4++;
                numFoto3++;
                numFoto3++;
                numFoto3++;
            }

            //var celda2decimales = parseInt(celda, 10).toFixed().toString();
            fila.appendChild(celda);
        }
        tabla.appendChild(fila);
    }

    d.appendChild(tabla);

    return false;
}


function esFecha(cadena) {
    if ((trim(cadena) == "") || (trim(cadena).length != 10))
        return false;
    var dia = parseInt(cadena.substr(0, 2), 10);
    var mes = parseInt(cadena.substr(3, 2), 10);
    var anio = parseInt(cadena.substr(6, 4), 10);
    // Año
    if (isNaN(anio) || (anio < 1900))
        return false;
    // Mes
    if (isNaN(mes) || (mes < 1) || (mes > 12))
        return false;
    // Día
    if (isNaN(dia) || (dia < 1) || (dia > 31))
        return false;
    else {
        if ((dia == 31) && ((mes == 4) || (mes == 6) || (mes == 9) || (mes == 11)))
            return false;
        var diaMax = 31;
        if ((anio % 4 == 0) && (anio % 100 != 0) || (anio % 400 == 0))
            diaMax = 29;
        else
            diaMax = 28;
        if (dia > diaMax)
            return false;
    }
    return true;
}
// -----------------------
// Elimina espacios al principio y fin de la cadena
function trim(cadena) {
    cadena += "";
    cadena = cadena.replace(/^\s+/, '');
    return cadena.replace(/\s+$/, '');
}

function alerta() {
    alert('Usuario o contraseña incorrectos');
}

function load() {
    //$('login').addEventListener('submit', validaLogin);
}
document.addEventListener('DOMContentLoaded', load, false);

function load2() {
    //$('divForm').addEventListener('submit', validaRegistro);
    //window.onload = tablaPrecios;
}
document.addEventListener('DOMContentLoaded', load2, false);