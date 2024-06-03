<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Health & Quality - Orden de Servicio</title>
  <style>
    .WordSection1 {
      size: 8.5in 11.0in;
      margin: 20.85pt 45.05pt;
    }

    div.WordSection1 {
      page: WordSection1;
    }


    .td-dark {
      background: black;
      padding: 0in 5.4pt 0in 5.4pt;
      color: white;
      border-collapse: collapse;
    }

    .td-light {
      padding: 0in 5.4pt 0in 5.4pt;
      color: black;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid #000000;
      border-collapse: collapse;
    }
  </style>
</head>

<body>
  <div class="WordSection1" >
    
      <div style="width: 150px; height: 150px;display: inline-block;">
        <img style="vertical-align: middle; width: 100%; height: 100%;" src="https://hq.intelica.mx/assets/img/ucin.png">
      </div>
      <div style="width: 310px; display: inline-block; vertical-align: middle;">
        <h2>REPORTE DE SERVICIO</h2>
      </div>
      <div style="width: 100px; display: inline-block;">
        <table style="width: 100%; ">
          <tr>
            <td class="td-dark">
              <h3>Folio</h3>
            </td>
          </tr>
          <tr>
            <td class="td-light">
              <p>{{ $order->number_id }}</p>
            </td>
          </tr>
        </table>
      </div>
    

    <div style="width:589px;display: flex;">
      <table style="width: 100%;">
        <tr>
          <td class="td-dark">
            <p>Fecha de atención:</p>
          </td>
          <td class="td-dark">
            <p>Reportado por:</p>
          </td>
          <td class="td-dark">
            <p>Número de reporte:</p>
          </td>
        </tr>
        <tr>
          <td class="td-light">
            <p>{{ $order->created_at->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY, h:mm:ss A') }}</p>
          </td>
          <td class="td-light">
            {{ $order->user->name }}</p> 
          </td>
          <td class="td-light">
            <p>{{ $order->number_id }}</p>
          </td>
        </tr>
      </table>
    </div>


    <div style="width:589px;display: flex;">
      <table style="width: 100%">
        <tr>
          <td class="td-dark" >
            <p>Datos cliente:</p>
          </td>
          <td class="td-dark">
            <p>Datos Instrumento:</p>
          </td>
        </tr>
        <tr>
          <td class="td-light">
            <p>
              <b>Cliente/Hospital:</b>{{$order->ticket->equipment->hospital->name}}
            </p>
          </td>
          <td class="td-light">
            <p>
              <b>Marca:</b>{{$order->ticket->equipment->brand->name}}
            </p>
          </td>
        </tr>
        <tr>
          <td class="td-light">
            <p>
              <b>Contacto:</b>{{$order->ticket->contact}}
            </p>
          </td>
          <td class="td-light">
            <p>
              <b>Modelo:</b>{{$order->ticket->equipment->models->name}}
            </p>
          </td>
        </tr>
        <tr>
          <td class="td-light">
            <p>
              <b>Direccion:</b><span>{{$order->ticket->adress}}</span>
            </p>
          </td>
          <td class="td-light">
            <p>
              <b>Serie:</b>{{$order->ticket->equipment->sr_no}}
            </p>
          </td>
        </tr>
      </table>
    </div>

    <p>&nbsp;</p>

    <div style="width:589px;display: flex;">
      <table style="width: 100%">
        <tr>
          <td colspan="3" class="td-dark">
            <p>Detalles de servicio:</p>
          </td>
        </tr>
        <tr>
          <td class="td-light" style="width: 34%" >
            <p>Fecha de Reporte: {{ $order->created_at->format('Y-m-d H:i:s') }} &nbsp; {{ $order->created_at->format('H') }}</p>
          </td>
          <td class="td-light" style="width: 33%">
            <p>Fecha de Cierre: {{ $order->created_at->format('Y-m-d H:i:s') }} &nbsp; {{ $order->created_at->format('H') }}</p>
          </td>
          <td class="td-light">
            <p>Tipo de servicio: {{ $order->ticket->category }}</p>
          </td>
        </tr>
      </table>
    </div>
    <div style="width:589px;display: flex;">
      <table style="width: 100%">
        <tr>
          <td class="td-dark">
            <p>Falla reportada:</p>
          </td>
        </tr>
        <tr>
          <td class="td-light">
            <p>{{$order->ticket->title}}</p>
          </td>
        </tr>
        <tr>
          <td class="td-dark">
            <p>Descripción de servicio:</p>
          </td>
        </tr>
        <tr>
          <td class="td-light">
            <p>{{$order->ticket->description}}</p>
          </td>
        </tr>
      </table>
    </div>
    <div style="width:589px;display: flex;">
      <table style="width: 100%">
        <tr>
          <td class="td-dark">
            <p>No. de parte:</p>
          </td>
          <td class="td-dark">
            <p>Descripción/Instrumento de medición:</p>
          </td>
          <td class="td-dark">
            <p>Cantidad:</p>
          </td>
        </tr>
        {{-- {% for item in tools %}
        <tr>
          <td class="td-light">
            {{-- <p>{{item.part}}</p> --}}
          </td>
          <td class="td-light">
            {{-- <p>{{item.description}}</p> --}}
          </td>
          <td class="td-light">
            {{-- <p>{{item.amount}}</p> --}}
          </td>
        </tr>
        {% endfor %} --}}

        <tr>
          <td class="td-light">
            <p>{{ $order->ticket->equipment->accesory ? $order->ticket->equipment->accesory->id : '-' }}</p>
        </td>
        <td class="td-light">
            <p>{{ $order->ticket->equipment->accesory ? $order->ticket->equipment->accesory->nombre : '-' }}</p>
        </td>
        <td class="td-light">
            <p>{{ $order->ticket->equipment->accesory ? $order->ticket->equipment->accesory->inventario : '-' }}</p>
        </td>
        </tr>
      </table>
    </div>
    <div style="width:589px;display: flex;">
      <table style="width: 100%">
        <tr>
          <td colspan="2" class="td-dark">
            <p>Observaciones:</p>
          </td>
        </tr>
        {{-- {% for item in service_order.message_so.all %}
        <tr>
          <td style="width: 20%" class="td-light">
            <p>{{ $order->created_at->format('Y-m-d H:i:s') }}</p>
          </td>
          <td class="td-light">
            {{-- <p>{{item.message}}</p> --}}
          </td>
        </tr>
        {% endfor %} --}}
        <tr>
          <td class="td-light">
            <p>{{ $order->created_at->format('Y-m-d H:i:s') }}</p>
          </td>
          <td class="td-light">
            <p>{{ $order->ticket->description }}</p>
          </td>
        </tr>
      </table>
    </div>
    <div style="width:589px;display: flex;">
      <table style="width: 100%">
        <tr>
          <td class="td-dark">
            <p>Evidencias:</p>
          </td>
        </tr>
        {{-- {% for item in service_order.images %}
        <tr>
          <td style="width: 100%" class="td-light">
            <img src="{{item | safe}}" style="vertical-align: middle;  width: 100%; height: 100%;"  alt=""/>
          </td>
        </tr>
        {% endfor %} --}}
        <tr>
          <td class="td-light">
            <img src="{{ asset('framework/public/images/' . $order->ticket->images) }}" style="vertical-align: middle; width: 100%; " alt=""/>
          </td>
      </table>
    </div>

    <p>&nbsp;</p>

    <div style="width:589px; display: flex; justify-content: space-between;">
      <div style="width: 250px; display: flex; flex-direction: column; align-items: center; text-align: center;  display: inline-block;">
          <div style="width: 150px; height: 60px; display: flex; align-items: center;">
              <img style="vertical-align: middle; width: 100%; height: 100%;" src="{{ $order->user_sign }}" alt="User Signature" />
          </div>
          <div>
              <strong>{{ $order->user->name }}</strong>
          </div>
          <div>
              _________________________________
          </div>
          <div>
              Nombre y firma de conformidad del usuario
          </div>
      </div>
      <div style="width: 250px; display: flex; flex-direction: column; align-items: center; text-align: center;  display: inline-block; padding-left:80px">
          <div style="width: 150px; height: 60px; display: flex; align-items: center;">
              <img style="vertical-align: middle; width: 100%; height: 100%;" src="{{ $order->specialist_sign }}" alt="Specialist Signature" />
          </div>
          <div>
              <strong>{{ $order->ticket->manager->name }}</strong>
          </div>
          <div>
              _________________________________
          </div>
          <div>
              Nombre y firma del ingeniero o especialista
          </div>
      </div>
  </div>
  

</body>

</html>