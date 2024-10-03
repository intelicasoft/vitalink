@php
   $u_e_id =
        \App\QrGenerate::where('id', $equipment->qr_id)->first() != null
            ? \App\QrGenerate::where('id', $equipment->qr_id)->first()->uid
            : '';
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etiqueta de Equipo</title>
    <style>
        @page {
 
            size: 14in 7in; /* Ancho: 8.5 pulgadas, Alto: 5.5 pulgadas (mitad de una hoja carta) */
            margin: 5;
        }

        body {
            /* transform: rotate(90deg); */
            font-family: Arial, sans-serif;
            font-size: 49px;
        }

        .container {
            border: 3px solid black;
            width: 1300px;
            height: 650px;
            padding: 0px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(2, 2, 2, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 0px;
            border-bottom: solid 1px black;
        }

        .logoImage {
            width: 380px;
            height: 180px;
            border-radius: 15pxpx;
        }

        .info-table {
            width: 100%;
            border-spacing: 5px;
        }

        .textos {
            vertical-align: top;
        }

        .qrImage img {
            width: 350px;
            height: 350px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img class="logoImage" src="{{ asset('framework/public/images/logo.png') }}" alt="Logo">
        </div>

        <table class="info-table">
            <tr>
                <td class="textos">
                    <div style="margin-bottom: 10px;"><strong>{{ $equipment->hospital->name }}</strong> </div>
                    {{-- <div style="margin-bottom: 10px;"><strong>Compañía:</strong> {{ $equipment->company }}</div> --}}
                    <div style="margin-bottom: 10px;"><strong>Número de Serie:{{ $equipment->sr_no }}</strong> </div>
                    <div style="margin-bottom: 10px;"><strong>Modelo:{{ $equipment->models->name }}</strong> </div>
                    <div style="margin-bottom: 10px;"><strong>Call center: +52 331486 96 52</strong> </div>
                    <div> <strong>serviciotecnico@ucinmedica.com</strong> </div>
                </td>
                <td class="qrImage">
                    <img src="{{ asset('uploads/qrcodes/qr_assign/' . $u_e_id . '.png') }}" alt="QR Code">
                </td>
            </tr>
        </table>
    </div>
</body>

