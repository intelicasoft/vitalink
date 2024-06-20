@extends('layouts.admin')
@section('body-title')
    Revisiones de Equipos
@endsection
@section('title')
    | Revisiones de Equipos
@endsection
@section('breadcrumb')
<li class="active">Revisiones de Equipos</li>
@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover dataTable bottom-padding" id="data_table">
                        <thead class="thead-inverse">
                            <tr>
                                <th> # </th>
                                <th> @lang('equicare.nombre')</th>
                                <th> Tipo de Marca </th>
                                <th> @lang('equicare.descripcion') </th>
                                <th> Última Fecha de Revisión </th>
                                @if(Auth::user()->can('Edit brands') || Auth::user()->can('Delete brands'))
                                <th> @lang('equicare.action')</th>
                                @endif 
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($equipos))
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($equipos as $equipo)
                            @php
                                $count++;
                                $ultimaRevision = \Carbon\Carbon::parse($equipo->ultima_fecha_revision);
                                $hoy = \Carbon\Carbon::now();
                                $diasDiferencia = $hoy->diffInDays($ultimaRevision);
                            @endphp
                            <tr>
                            <td> {{ $count }} </td>
                            <td> {{ ucfirst($equipo->name) }} </td>
                            <td> {{ $equipo->hospital->name ?? '-' }}</td>
                            <td> {{ $equipo->description ?? '-' }}</td>
                            <td> {{ $equipo->ultima_fecha_revision ?? '-' }}</td>

                            <td>
                                {!! Form::open(['url' => 'admin/reviews/'.$equipo->id,'method'=>'DELETE','class'=>'form-inline']) !!}
                                    @if ($hoy)
                                    <a href="{{ route('reviews.edit',$equipo->id) }}" class="btn bg-purple btn-sm btn-flat" title="@lang('equicare.edit')"><i class="fa fa-check"></i> Revisar </a>
                                    @endif
                                    
                                {!! Form::close() !!}
                            </td>
    
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> # </th>
                                <th> Nombre</th>
                                <th> Tipo de Marca </th>
                                <th> Descripcion </th>
                                <th> Última Fecha de Revisión </th>
                                @if(Auth::user()->can('Edit brands') || Auth::user()->can('Delete brands'))
                                <th> @lang('equicare.action')</th>
                                @endif
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
