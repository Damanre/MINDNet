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