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
                            <b>@lang('equicare.name')</b> : {{ $equipment->name ?? '' }}
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </h4>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            @include('equipments.equipment')
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <!-- The time line -->
                    <ul class="timeline">
                     {{-- <script>
                        console.log(@json($data));
                    </script> --}}
                        @if($data->count() > 0)
                            @foreach($data as $d)
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-red">
                                        {{ date('Y-m-d', strtotime($d['created_at'])) }}
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    @if($d['type'] == 'Ticket')
                                        <i class="fa fa-ticket bg-green"></i>
                                    @endif

                                    <div class="timeline-item">
                                        <span class="time">
                                            <i class="fa fa-clock-o"></i> {{ date('h:i A', strtotime($d['created_at'])) }}
                                        </span>
                                        <span class="time">
                                            <!-- Aquí puedes agregar enlaces adicionales según el tipo de ticket si es necesario -->
                                            @if($d['status'] == '1')

                                            <a href="{{ route('tickets.edit', $d['id']) }}" title="@lang('equicare.edit')" class="h4">
                                                <i class="fa fa-edit purple-color"></i> @lang('equicare.edit')
                                            </a>
                                             @endif
                                        </span>
                                        <h3 class="timeline-header text-blue">
                                            <b>{{ $d['category'] }}</b>
                                        </h3>

                                        <div class="timeline-body">
                                             <div class="row">
                                                <div class="col-md-4">
                                                   <b>Titulo</b> : {{ $d['title'] ?? '-' }}
                                                </div>
                                                <div class="col-md-4">
                                                   <b>Encargado</b> : {{ $d['manager']['name'] ?? '-' }}
                                                </div>
                                                <div class="col-md-4">
                                                   <b>Equipo Clínico</b> : {{ $d['equipment']['sr_no'] ?? '-' }}
                                                </div>
                                                <div class="col-md-4">
                                                   <b>Fecha de Registro</b> : {{ date('Y-m-d h:i A', strtotime($d['created_at'])) ?? '-' }}
                                                </div>
                                                <div class="col-md-4">
                                                   <b>Estado</b> : {{ $d['status'] ?? '-' }}
                                                </div>
                                                <div class="col-md-4">
                                                   <b>Fecha de Cierre</b> : {{ date('Y-m-d h:i A', strtotime($d['deleted_at'])) ?? '-' }}
                                                </div>
                                         
                                                <div class="col-md-12">
                                                   <b>Descripción</b> : {{ $d['description'] ?? '-' }}
                                                </div>
                                                <div class="col-md-12">
                                                   <b>Dirección</b> : {{ $d['adress'] ?? '-' }}
                                                </div>
                                                <div class="col-md-12">
                                                   <b>Teléfono</b> : {{ $d['phone'] ?? '-' }}
                                                </div>
                                                <div class="col-md-12">
                                                   <b>Contacto</b> : {{ $d['contact'] ?? '-' }}
                                                </div>

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
                                    <div class="timeline-body"></div>
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
@endsection
