<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de servicio</title>
    <style>
        /* Estilos CSS para el PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Ordenes de servicio</h1>
    <table>
        <thead>
            <tr>
                <th>Número de Orden</th>
                <th>Estado</th>
                <th>Usuario</th>
                <th>Ticket</th>
                <th>Imágenes</th>
                <th>Mantenimiento</th>
                <th>Fecha de creación</th>
                <!-- Agregar más columnas según sea necesario -->
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->number_id }}</td>
                <td>
                    @if($order->status == 1)
                        Abierto
                    @elseif($order->status == 2)
                        Cerrado
                    @else
                        Desconocido
                    @endif
                </td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->ticket->title }}</td>
                <td>{{ $order->images }}</td>
                <td>{{ $order->maintenance_id }}</td>
                <td>{{ $order->created_at }}</td>
                <!-- Agregar más columnas según sea necesario -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>