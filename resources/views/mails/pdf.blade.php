<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar pdf</title>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>

</head>

<body>
    @foreach ($fotos as $foto)

    <img src="img/{{$foto}}" width="700" height="930">
    <div class="page-break">Pronto Gestion</div>
    @endforeach


</body>

</html>