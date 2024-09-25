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
        top: 10;
        left: 10;
        width: 200px; 
        height: 93px; 
        border-radius: 15px;" src="{{ asset('framework/public/images/logo.png') }}" alt="Logo">
        
        <div style="width: 500px; height: auto; display: inline-block; vertical-align: middle; padding-top:120px">
                
                <div><strong>Hospital:</strong> {{ $equipment->hospital->name }}</div>
                <div><strong>Compañía:</strong> {{ $equipment->company }}</div>
                
                <div><strong>Número de Serie:</strong> {{ $equipment->sr_no }}</div>
                
                <div><strong>Modelo:</strong> {{ $equipment->models->name }}</div>
                <div><strong>Call center:</strong> +52 331486 96 52</div>
                <div><strong>Correo:</strong> serviciotecnico@ucinmedica.com</div>
                
    </div>
        <div  style="width: 400px; height: auto;display: inline-block;  ">
            <img style="vertical-align: middle; width: 400px; height: 400px; padding-top:100px; border-radius: 15px;" src="{{ asset('uploads/qrcodes/qr_assign/'.$u_e_id.'.png') }}" alt="QR Code">
        </div>
    </div>
</body>
</html>
