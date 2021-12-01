var c;
c=$(document); //Creamos una nueva copia de document.
c.ready(eventos()); // Cuando x esté lista ejecutaremos inicializarEventos

function eventos(){
    repetir();
    setInterval(repetir, 500);
}

function repetir(){
    $.ajax({
        url:   'getchat.php',
        type:  'post',
        datatype: 'php',
        async: 'true',
        success:  function (datos) {
            document.getElementById("chat").innerHTML=datos;
        }

    });
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}