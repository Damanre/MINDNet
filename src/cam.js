var x;
x=$(document); //Creamos una nueva copia de document.
x.ready(inicializarEventos); // Cuando x esté lista ejecutaremos inicializarEventos

function inicializarEventos()
{
    navigator.mediaDevices.getUserMedia({video:true}).then((stream) => {
        document.getElementById("vid").srcObject = stream;
    });
}