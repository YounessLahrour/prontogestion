<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Para Extranjeros</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
    <!-- PWA assets-->
    @laravelPWA

</head>

<body onbeforeunload="return refrescar()">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

    <div class="container">
        @if ($texto=Session::get('mensaje'))
        <p class="alert alert-success my-3">{{$texto}}</p>
        @endif
        <div class="row justify-content-center pt-2 mt-4 m-1">
            <div class="col-md-6 col-sm-8 col-xl-4 col-lg-5 formulario" style="padding-top: 0px;">
                <form action="{{route('enviados.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group text-center pt-3" style="padding-top: 2px; margin-bottom: 0px;">
                        <img src="img/globo.png" alt="" width="80" height="80">
                        <p class="text-light" style="font-size: 22px;margin-bottom: 0px;">Para Extranjeros</p>
                    </div>
                    <div class="form-group mx-sm-4 pt-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="lnr lnr-user"></i></div>
                            <input id="nombre" type="text" class="form-control  @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('email') }}" placeholder="Nombre" autocomplete="nombre" required>
                        </div>
                    </div>
                    <div class="form-group mx-sm-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="lnr lnr-text-format"></i></div>
                            <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" placeholder="Apellido" autocomplete="apellido" required>

                        </div>
                    </div>
                    <div class="form-group mx-sm-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="lnr lnr-phone-handset"></i></div>
                            <input id="telefono" type="tel" class="form-control @error('password') is-invalid @enderror" pattern="[6|7|9]{1}[0-9]{8}" name="telefono" placeholder="Teléfono" minlength="9" maxlength="9" autocomplete="telefono" required>
                        </div>
                    </div>

                    <div class="form-group mx-sm-4" style="margin-bottom: 0px;margin-top: 0px;">

                        <div class="input-group-prepend">
                            <p id="reproductor" style=" margin-bottom: 0px;">
                                <audio controls style="padding-right: 0px;width: 210px;height: 40px;margin-right: 2px;margin-bottom: 0px;border-top-width: 2px;margin-top: 2px;">
                                    <source id="borrar" src="" type="audio/webm"></audio>

                            </p>
                            <span id="duracion" style="  margin-right: 0px;  border-right-width: 2px;  padding-right: 2px;  margin-top: 8px;">00:00</span> <i id="demo" class="fas fa-microphone fa-1x " style="

  border-radius: 50%;
  background-color: green;
  display: inline-block;
  box-shadow: 0px 0px 2px #888;
  padding: 0.5em 0.6em;
  height: 33px;
  border-top-width: 5px;
  margin-top: 5px;
  margin-right: 5px;
  margin-left: 8px;
  "></i>


                            <input type="hidden" name="audio" id="audio" value="">
                            <input type="hidden" name="lat" id="lat" value="">
                            <input type="hidden" name="lng" id="lng" value="">
                            <audio hidden id="reproducir" controls>
                                <source type="audio/mp3" src="beep.mp3">
                            </audio>
                        </div>
                    </div>
                    @if ($texto=Session::get('error'))
                    <p class="alert alert-danger my-3">{{$texto}}</p>
                    @endif
                    <div class="form-group mx-sm-4">
                        <div class="input-group-prepend">

                            <span id="glosaArchivos" style=" margin-top: 5px;">Ningún archivo seleccionado</span>
                            <div class="input-group-text ml-2"><i id="attachment" class="lnr lnr-picture"></i></div>
                            <input id="archivo" type="file" hidden name="file[]" accept="image/*" multiple>
                        </div>
                    </div>

                    <div class="form-group mx-sm-4 ">
                        <input type="submit" id="enviar" class="btn btn-block iniciar" onclick="cambiar()" value="Enviar">
                    </div>
                </form>
                <div>
                    <select name="listaDeDispositivos" id="listaDeDispositivos" hidden></select>
                </div>

            </div>
        </div>
    </div>
    <script>
        function cambiar() {
            let nombre = document.getElementById("nombre").value;
            let apellido = document.getElementById("apellido").value;
            let telefono = document.getElementById("telefono").value;
            var punto = "Enviando.";
            var contador = 0;
            if (nombre != "" && apellido != "" && telefono.length == 9) {
                setInterval(function() {
                    if (punto == "Enviando....") {
                        punto = "Enviando.";
                    }
                    document.getElementById("enviar").value = punto;
                    punto = punto + ".";

                }, 1000);

            }

        }

        function refrescar() {
            if (document.getElementById("borrar").getAttribute("src") != "" && document.getElementById("enviar").value == "Enviar") {
                RUTA_SERVIDOR = "borrar.php?borrar=" + document.getElementById("borrar").getAttribute("src");
                const formData = new FormData();
                formData.append("borrar", "blobAudio");
                fetch(RUTA_SERVIDOR, {
                    method: "POST",
                    body: formData,
                });
            }
        }

        if (navigator.geolocation) {
            var success = function(position) {
                var latitud = position.coords.latitude,
                    longitud = position.coords.longitude;
                document.getElementById("lat").value = latitud;
                document.getElementById("lng").value = longitud;
            }
            navigator.geolocation.getCurrentPosition(success, function(msg) {
                console.error(msg);
            });
        }
        const init = () => {
            var reproducir = document.getElementById("reproducir");
            var start;
            var end;
            var elapse;
            const tieneSoporteUserMedia = () =>
                !!(navigator.mediaDevices.getUserMedia)

            // Si no soporta...
            // Amable aviso para que el mundo comience a usar navegadores decentes ;)
            if (typeof MediaRecorder === "undefined" || !tieneSoporteUserMedia())
                return alert("Tu navegador web no cumple los requisitos; por favor, actualiza a un navegador decente como Firefox o Google Chrome");


            // Declaración de elementos del DOM
            const $listaDeDispositivos = document.querySelector("#listaDeDispositivos"),
                $duracion = document.getElementById("duracion"),
                $audio = document.getElementById("audio"),

                $btnComenzarGrabacion = document.querySelector("#btnComenzarGrabacion"),
                $btnDetenerGrabacion = document.querySelector("#btnDetenerGrabacion");

            // Algunas funciones útiles
            const limpiarSelect = () => {
                for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--) {
                    $listaDeDispositivos.options.remove(x);
                }
            }

            const segundosATiempo = numeroDeSegundos => {
                let horas = Math.floor(numeroDeSegundos / 60 / 60);
                numeroDeSegundos -= horas * 60 * 60;
                let minutos = Math.floor(numeroDeSegundos / 60);
                numeroDeSegundos -= minutos * 60;
                numeroDeSegundos = parseInt(numeroDeSegundos);
                if (horas < 10) horas = "0" + horas;
                if (minutos < 10) minutos = "0" + minutos;
                if (numeroDeSegundos < 10) numeroDeSegundos = "0" + numeroDeSegundos;

                return `${minutos}:${numeroDeSegundos}`;
            };
            // Variables "globales"
            let tiempoInicio, mediaRecorder, idIntervalo;
            const refrescar = () => {
                $duracion.textContent = segundosATiempo((Date.now() - tiempoInicio) / 1000);
            }
            // Consulta la lista de dispositivos de entrada de audio y llena el select
            const llenarLista = () => {
                navigator
                    .mediaDevices
                    .enumerateDevices()
                    .then(dispositivos => {
                        limpiarSelect();
                        dispositivos.forEach((dispositivo, indice) => {
                            if (dispositivo.kind === "audioinput") {
                                const $opcion = document.createElement("option");
                                // Firefox no trae nada con label, que viva la privacidad
                                // y que muera la compatibilidad
                                $opcion.text = dispositivo.label || `Dispositivo ${indice + 1}`;
                                $opcion.value = dispositivo.deviceId;
                                $listaDeDispositivos.appendChild($opcion);
                            }
                        })
                    })
            };
            // Ayudante para la duración; no ayuda en nada pero muestra algo informativo
            const comenzarAContar = () => {
                tiempoInicio = Date.now();
                idIntervalo = setInterval(refrescar, 50);
            };
            navigator.mediaDevices.getUserMedia({
                audio: {
                    deviceId: $listaDeDispositivos.value,
                }
            })
            // Comienza a grabar el audio con el dispositivo seleccionado
            const comenzarAGrabar = () => {

                if (!$listaDeDispositivos.options.length) return alert("No hay dispositivos");
                // No permitir que se grabe doblemente
                //if (mediaRecorder) return alert("Ya se está grabando");

                navigator.mediaDevices.getUserMedia({
                        audio: {
                            deviceId: $listaDeDispositivos.value,
                        }
                    })
                    .then(stream => {
                        // Comenzar a grabar con el stream

                        mediaRecorder = new MediaRecorder(stream);
                        mediaRecorder.start();
                        document.getElementById('duracion').style.color = 'red';
                        // En el arreglo pondremos los datos que traiga el evento dataavailable
                        const fragmentosDeAudio = [];
                        // Escuchar cuando haya datos disponibles
                        mediaRecorder.addEventListener("dataavailable", evento => {
                            // Y agregarlos a los fragmentos
                            fragmentosDeAudio.push(evento.data);
                        });
                        // Cuando se detenga (haciendo click en el botón) se ejecuta esto
                        mediaRecorder.addEventListener("stop", () => {
                            // Detener el stream
                            stream.getTracks().forEach(track => track.stop());
                            // Detener la cuenta regresiva

                            // Convertir los fragmentos a un objeto binario
                            const blobAudio = new Blob(fragmentosDeAudio);
                            const formData = new FormData();
                            // Enviar el BinaryLargeObject con FormData

                            formData.append("audio", blobAudio);

                            //formData.append("borrar", document.getElementById("borrar").getAttribute("src"));
                            //alert(document.getElementById("borrar").getAttribute("src"));
                            var RUTA_SERVIDOR;
                            if (document.getElementById("borrar").getAttribute("src") == "") {

                                RUTA_SERVIDOR = "guardar.php";
                            } else {
                                RUTA_SERVIDOR = "guardar.php?borrar=" + document.getElementById("borrar").getAttribute("src");
                            }


                            fetch(RUTA_SERVIDOR, {
                                    method: "POST",
                                    body: formData,
                                })
                                .then(respuestaRaw => respuestaRaw.text()) // Decodificar como texto
                                .then(respuestaComoTexto => {
                                    // Aquí haz algo con la respuesta ;)
                                    $audio.value = respuestaComoTexto;
                                    console.log("La respuesta: ", respuestaComoTexto);
                                    // Abrir el archivo, es opcional y solo lo pongo como demostración${respuestaComoTexto} 
                                    $duracion.textContent = "00:00";
                                    document.getElementById("reproductor").innerHTML = `<audio  controls style="padding-right: 0px;width: 210px;height: 40px;margin-right: 2px;margin-bottom: 0px;border-top-width: 2px;margin-top: 2px;"><source id="borrar"  src="${'img/'+respuestaComoTexto}" type="audio/webm"></audio>`;

                                })
                        });
                    })
                    .catch(error => {
                        //alert(error);
                        if (error == "NotAllowedError: Permission denied") {

                            navigator.mediaDevices.getUserMedia({
                                audio: {
                                    deviceId: $listaDeDispositivos.value,
                                }
                            })
                            // Explain why you need permission and how to update the permission setting
                        }
                        // Aquí maneja el error, tal vez no dieron permiso
                        // alert("No podemos grabarte, no nos dio permiso");

                        // console.log(error);
                    });
            };


            const detenerConteo = () => {
                clearInterval(idIntervalo);
                tiempoInicio = null;
                $duracion.textContent = "00:00";
            }

            function detenerGrabacion() {
                if (!mediaRecorder) return alert("Mantén pulsado para grabar.");
                mediaRecorder.stop();
                mediaRecorder = null;
            }

            var timePressed = 0;
            var timer, timePressed = 0;
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                document.getElementById("demo").addEventListener("touchstart", function(e) {

                    navigator.permissions.query({
                        name: 'geolocation'
                    }).then(function(permissionStatus) {
                        if (permissionStatus.state == "denied") {
                            alert("No tenemos permiso para grabarte.");
                        } else {
                            reproducir.play();
                            timePressed = 0;
                            timer = setInterval(function() {
                                timePressed += 100;
                                if (timePressed > 200) {

                                    comenzarAContar();
                                    comenzarAGrabar();
                                    clearInterval(timer);
                                }
                            }, 100);
                        }
                    });


                });

                document.getElementById("demo").addEventListener("touchend", function(e) {
                    document.getElementById('duracion').style.color = 'white';
                    detenerGrabacion();
                    detenerConteo();
                    clearInterval(timer);
                });
            } else {
                document.getElementById("demo").addEventListener("mousedown", function(e) {
                    navigator.permissions.query({
                        name: 'geolocation'
                    }).then(function(permissionStatus) {
                        if (permissionStatus.state == "denied") {
                            alert("No tenemos permiso para grabarte.");
                        } else {
                            reproducir.play();
                            timePressed = 0;
                            timer = setInterval(function() {
                                timePressed += 100;
                                if (timePressed > 200) {
                                    comenzarAContar();
                                    comenzarAGrabar();
                                    clearInterval(timer);
                                }
                            }, 100);
                        }
                    });
                });
                document.getElementById("demo").addEventListener("mouseup", function(e) {
                    document.getElementById('duracion').style.color = 'white';
                    detenerGrabacion();
                    detenerConteo();
                    clearInterval(timer);
                });
            }


            document.getElementById("attachment").addEventListener('click', function() {
                document.getElementById("archivo").click();

            });

            document.getElementById("archivo").addEventListener("change", contar);

            function contar() {
                var glosa = document.getElementById("glosaArchivos");
                var elem = document.getElementById("archivo");
                if (elem.files.length == 0) {
                    glosa.innerText = "Ningun archivo seleccionado";
                } else {
                    glosa.innerText = elem.files.length + " archivos";
                }
            }
            // $btnComenzarGrabacion.addEventListener("click", comenzarAGrabar);
            //$btnDetenerGrabacion.addEventListener("click", detenerGrabacion);
            // Cuando ya hemos configurado lo necesario allá arriba llenamos la lista
            llenarLista();
        }
        // Esperar a que el documento esté listo...
        document.addEventListener("DOMContentLoaded", init);
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>