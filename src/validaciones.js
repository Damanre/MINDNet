var expdni = /^[0-9]{7,8}[a-z A-Z]$/;
var letra ="TRWAGMYFPDXBNJZSQVHLCKE"

var x;
x=$(document); //Creamos una nueva copia de document.
x.ready(inicializarEventos); // Cuando x esté lista ejecutaremos inicializarEventos

function inicializarEventos()
{
    valdni();
}



function valdni(){
    $("#rnombre").blur(function(){
        if(1==1){
            if(parseInt($("#rdni").val().substring(0,$("#rdni").val().length-1))%23==letra.indexOf($("#rdni").val().substr($("#rdni").val().length-1).toUpperCase())){
                document.getElementById("rdni").style.border = "2px solid green";
            }else{
                document.getElementById("rdni").style.border = "2px solid red";
            }
        }else{
            document.getElementById("rdni").style.border = "2px solid red";
        };
    });
    $("#rdni").blur(function(){
        if(expdni.test($("#rdni").val())){
            if(parseInt($("#rdni").val().substring(0,$("#rdni").val().length-1))%23==letra.indexOf($("#rdni").val().substr($("#rdni").val().length-1).toUpperCase())){
                document.getElementById("rdni").style.border = "2px solid green";
            }else{
                document.getElementById("rdni").style.border = "2px solid red";
            }
        }else{
            document.getElementById("rdni").style.border = "2px solid red";
        };
    });
    $("#cookiebtn").click(function(){
        $("#cookiebox").fadeOut();
    });
}




