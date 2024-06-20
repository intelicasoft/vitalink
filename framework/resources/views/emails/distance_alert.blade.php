<!DOCTYPE html>
<html>
<head>
    <title>Alerta de distancia</title>
</head>
<body>
    <p>Hola Administrador,</p>
    <p>El usuario {{ $user->name }} (ID: {{ $user->id }}) ha intentado hacer una revisión de un equipo fuera de la zona permitida.</p>
    <p>Distancia reportada: {{ $distance }}km</p>
</body>
</html>