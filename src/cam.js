var x;
x=$(document); //Creamos una nueva copia de document.
x.ready(eventos()); // Cuando x esté lista ejecutaremos inicializarEventos

function eventos(){
    window.URL = window.URL || mindow.webkitURL;
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

    navigator.getUserMedia({audio:true , video:true}, function(vid){
        document.querySelector("video").src = window.URL.createObjectURL(vid);
    });
}