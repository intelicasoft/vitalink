@extends('layouts.app')
@section('body-title')
@lang('equicare.equipment_history')
@endsection
@section('title')
| @lang('equicare.equipment_history')
@endsection
@section('breadcrumb')
<li class="active">@lang('equicare.equipment_history')</li>
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <h2>@lang('equicare.equipment_history')</h2>
         <div class="box box-primary">
            <div class="box-header with-border">
                  <h4 class="box-title" style="float:left;">
                     <b>@lang('equicare.name')</b> : {{$equipment->name?? ''}}
                     &nbsp;&nbsp;&nbsp;&nbsp;
                  </h4>
                  @if(\Auth::user())
                  <h4 class="box-title" style="float:right;">
                     <a href="{{ route('equipments.edit',$equipment->id) }}" class="h4" title="@lang('equicare.edit')"><i class="fa fa-edit purple-color"></i> @lang('equicare.edit')</a>   
                  </h4>
                  @endif
            </div>      

            <div class="box-body">
               <div class="row">
                  @include('equipments.equipment')
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <h4>Distancia al equipo desde tu ubicación: <span id="distance"></span> km</h4>
                  </div>
               </div>
            </div>
         </div>
         
         <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">
            
            @if($data->count() > 0)
               @foreach($data as $d)
               <!-- timeline time label -->
               <li class="time-label">
                     <span class="bg-red">
                        {{date('Y-m-d',strtotime($d['created_at']))}}
                     </span>
               </li>
               <!-- /.timeline-label -->
               <!-- timeline item -->
               <li>
                  @if($d['type'] == 'Call')
                     <i class="fa fa-phone bg-green"></i>
                  @else
                     <i class="fa fa-balance-scale bg-green"></i>
                  @endif               

                  <div class="timeline-item">
                     <span class="time">
                        <i class="fa fa-clock-o"></i> {{date('h:i A',strtotime($d['created_at']))}}
                     </span>
                     <span class="time">
                        @if($d['type'] == 'Call' && $d['call_type'] == 'breakdown')
                           <a href="{{ route('breakdown_maintenance.edit',$d['id']) }}" title="@lang('equicare.edit')" class="h4"><i class="fa fa-edit purple-color" ></i> @lang('equicare.edit') </a>
                        @elseif($d['type'] == 'Call' && $d['call_type'] == 'preventive')
                           <a href="{{ route('preventive_maintenance.edit',$d['id']) }}" title="@lang('equicare.edit')" class="h4"><i class="fa fa-edit purple-color" ></i> @lang('equicare.edit') </a>
                        @endif
                     </span>
                     <h3 class="timeline-header text-blue">
                        <b>{{$d['type']}} 
                        @if($d['type'] == 'Call')
                         - {{$d['call_type']}}
                        @endif
                        </b>
                     </h3>

                     <div class="timeline-body">
                        <div class="row">
                           @if($d['type'] == 'Call')
                              @include('equipments.call')
                           @else
                              @include('equipments.calibration')
                           @endif
                        </div>
                     </div>
                  </div>
               </li>        
               @endforeach 
            @else
               <!-- timeline item -->
               <li>
                     <i class="fa fa-circle bg-green"></i>

                  <div class="timeline-item">                  
                     <h3 class="timeline-header text-blue">
                        No History Found for this Equipment.
                     </h3>

                     <div class="timeline-body">
                        
                     </div>
                  </div>
               </li>
            @endif
              <li>
                 
                <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul>
         </div>

      </div>
   </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(function(position) {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;
            const equipmentLat = {{$equipment->latitude}};
            const equipmentLng = {{$equipment->longitude}};
            const distance = haversine(userLat, userLng, equipmentLat, equipmentLng);
            document.getElementById('distance').innerText = distance.toFixed(2);
            console.log(distance);
            // Mostrar alerta si la distancia es menor a 2 km
            if (distance > 1) {
                alert('Te encuentras fuera de la zona permitida, la revision no es valida y se le notificara al administrador.');
            }
        });
    } else {
        alert('Geolocation is not supported by this browser.');
    }
});

function haversine(lat1, lon1, lat2, lon2) {
    function toRad(x) {
        return x * Math.PI / 180;
    }

    const R = 6371; // Radius of the Earth in km
    const dLat = toRad(lat2 - lat1);
    const dLon = toRad(lon2 - lon1);
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
              Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
}
</script>
@endsection
