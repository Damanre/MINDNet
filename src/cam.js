// Generar un numero aleatorio de room si es necesario
if (!location.hash) {
    location.hash = Math.floor(Math.random() * 0xFFFFFF).toString(16);
}
const roomHash = location.hash.substring(1);
const drone = new ScaleDrone('yiS12Ts5RdNhebyM');
// El numero generado se añade a URL con 'observable-'
document.cookie = "hash="+roomHash;// Se guarda el numero generado en una cookie
const roomName = 'observable-' + roomHash;
const configuration = {
    iceServers: [{ //Servidor de comunicacion RTC
        urls: 'stun:stun.l.google.com:19302'
    }]
};
let room;
let pc;


function onError(error) {
    console.error(error);//Muestra el error en la consola
};


drone.on('open', error => {
    if (error) {
        return console.error(error);//Muestra el error en la consola
    }
    room = drone.subscribe(roomName);
    room.on('open', error => {
        if (error) {
            onError(error);
        }
    });
    // Conexion a la room y obtencion de miembros activos
    room.on('members', members => {
        console.log('MEMBERS', members);
        // Si somos el segundo usuario entraremos en la room
        const isOfferer = members.length === 2;
        startWebRTC(isOfferer);
    });
});

function sendMessage(message) {
    drone.publish({
        room: roomName,
        message
    });
}

function startWebRTC(isOfferer) {
    pc = new RTCPeerConnection(configuration);
    pc.onicecandidate = event => {
        if (event.candidate) {
            sendMessage({'candidate': event.candidate});
        }
    };

    if (isOfferer) {
        pc.onnegotiationneeded = () => {
            pc.createOffer().then(localDescCreated).catch(onError);
        }
    }

    // Mostrar video Remoto
    pc.ontrack = event => {
        const stream = event.streams[0];
        if (!remoteVideo.srcObject || remoteVideo.srcObject.id !== stream.id) {
            remoteVideo.srcObject = stream;
        }
    };

    navigator.mediaDevices.getUserMedia({
	    audio: true,
        video: true,
    }).then(stream => {
        // Mostrar video local
        localVideo.srcObject = stream;
        // Enviar video local
        stream.getTracks().forEach(track => pc.addTrack(track, stream));
    }, onError);

    room.on('data', (message, client) => {
        if (client.id === drone.clientId) {
            return;
        }

        if (message.sdp) {
            // Al recibir respuesta o solicitud
            pc.setRemoteDescription(new RTCSessionDescription(message.sdp), () => {
                // Cuando recibe una solicitud de union este responde
                if (pc.remoteDescription.type === 'offer') {
                    pc.createAnswer().then(localDescCreated).catch(onError);
                }
            }, onError);
        } else if (message.candidate) {
            pc.addIceCandidate(
                new RTCIceCandidate(message.candidate), onSuccess, onError
            );
        }
    });
}

function localDescCreated(desc) {
    pc.setLocalDescription(
        desc,
        () => sendMessage({'sdp': pc.localDescription}),
        onError
    );
}