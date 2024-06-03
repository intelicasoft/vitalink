@php
$u_e_id = (\App\QrGenerate::where('id', $equipment->qr_id)->first() != null) ? \App\QrGenerate::where('id', $equipment->qr_id)->first()->uid : '';
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etiqueta de Equipo</title>
    <style>
        @page {
            size: letter;
        }
        body {
            transform: rotate(90deg);
            font-family: Arial, sans-serif;
            font-size: 32px; /* Aumenta el tamaño de la fuente */
        }
        .container {
            border: 3px solid black;
            width:  1000px;
            height: 650px;
            padding: 10px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }




    </style>
</head>
<body>
   
    <div  class="container">
        <img style="position: absolute;
        top: 0;
        left: 0;
        width: 300px; 
        height: 100px; 
        border-radius: 15px;" src="{{ asset('framework/public/images/logo.png') }}" alt="Logo">
        
        <div style="width: 590px; height: auto; display: inline-block; vertical-align: middle; padding-top:160px">
                
                <div><strong>Nombre:</strong> {{ $equipment->name }}</div>
                {{-- <div><strong>Nombre Corto:</strong> {{ $equipment->short_name }}</div> --}}
                {{-- <div><strong>ID de Usuario:</strong> {{ $equipment->user_id }}</div> --}}
                <div><strong>Hospital:</strong> {{ $equipment->hospital->name }}</div>
                <div><strong>Compañía:</strong> {{ $equipment->company }}</div>
                <div><strong>Modelo:</strong> {{ $equipment->model }}</div>
                <div><strong>Número de Serie:</strong> {{ $equipment->sr_no }}</div>
                {{-- <div><strong>ID Único:</strong> {{ $equipment->unique_id }}</div> --}}
                {{-- <div><strong>Departamento:</strong> {{ $equipment->department }}</div> --}}
                <div><strong>Fecha de Orden:</strong> {{ $equipment->order_date }}</div>
                <div><strong>Fecha de Compra:</strong> {{ $equipment->date_of_purchase }}</div>
                <div><strong>Fecha de Instalación:</strong> {{ $equipment->date_of_installation }}</div>
                <div><strong>Vencimiento de Garantía:</strong> {{ $equipment->warranty_due_date }}</div>
                <div><strong>Número de Ingeniero de Servicio:</strong> {{ $equipment->service_engineer_no }}</div>
                {{-- <div><strong>Es Crítico:</strong> {{ $equipment->is_critical ? 'Sí' : 'No' }}</div> --}}
                {{-- <div><strong>Notas:</strong> {{ $equipment->notes }}</div> --}}
                {{-- <div><strong>ID QR:</strong> {{ $equipment->qr_id }}</div> --}}
                {{-- <div><strong>ID de Marca:</strong> {{ $equipment->brand_id }}</div> --}}
                {{-- <div><strong>ID de Accesorio:</strong> {{ $equipment->accesory_id }}</div> --}}
                <div><strong>Modelo:</strong> {{ $equipment->models->name }}</div>
                
    </div>
        <div  style="width: 400px; height: auto;display: inline-block;  ">
            <img style="vertical-align: middle; width: 400px; height: 400px; padding-top:100px; border-radius: 15px;" src="{{ asset('uploads/qrcodes/qr_assign/'.$u_e_id.'.png') }}" alt="QR Code">
        </div>
    </div>
</body>
</html>
