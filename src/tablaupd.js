var x;
x=$(document); //Creamos una nueva copia de document.
x.ready(eventos()); // Cuando x esté lista ejecutaremos inicializarEventos

function eventos(){
    repetir();
    setInterval(repetir, 500);
}

function repetir(){
    $.ajax({
        url:   'gettable.php',
        type:  'post',
        datatype: 'php',
        async: 'true',
        success:  function (datos) {
            document.getElementById("tabla").innerHTML=datos;
        }
    });

}