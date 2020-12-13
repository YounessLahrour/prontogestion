<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
    
    <p>Estos son los datos del cliente que ha realizado la consulta:</p>
    <ul>
        <li>Nombre: {{ $nombre }} {{$apellido}}</li>
        <li>Teléfono: {{ $telefono }}</li>
    </ul>
    <p>Ubicación del cliente</p>
    <ul>
        <li>Latitud: {{ $lat }}</li>
        <li>Longitud: {{ $lng }}</li>
        <li>
            <a href="https://www.google.com/maps/dir/{{ $lat }},{{ $lng }}">
                Ver en Google Maps
            </a>
        </li>
    </ul>
</body>
</html>