@extends('layouts.admin')
@section('body-title')
    @lang('Zonas')
@endsection
@section('title')
	| @lang('Zonas')
@endsection
@section('breadcrumb')
<li class="active">Zonas</li>
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"> Manejar Zonas
						@if(Auth::user()->can('Create zones'))
                            <a href="{{ route('zones.create') }}" class="btn btn-primary btn-flat">Agregar</a></h4>
                        @endif
				</div>

				<div class="box-body table-responsive">
					<table class="table table-bordered table-hover dataTable bottom-padding" id="data_table">
						<thead class="thead-inverse">
							<tr>
								<th> # </th>
								<th>Zona</th>
								<th> Encargado</th>
								<th> Correo</th>
								@if(Auth::user()->can('Edit zones') || Auth::user()->can('Delete zones'))
								<th> @lang('equicare.action')</th>
								@endif 
							</tr>
						</thead>
						<tbody>
							@if (isset($zones))
							@php
								$count = 0;
							@endphp
							@foreach ($zones as $zone)
							@php
								$count++;
							@endphp
							<tr>
							<td> {{ $count }} </td>
							<td>{{	$zone->zone}}</td>
							<td> {{ ucfirst($zone->name) }} </td>
							<td> {{ $zone->manager_email ?? '-' }}</td>
							
							@if(Auth::user()->can('Edit zones') || Auth::user()->can('Delete zones'))
								<td>
									{!! Form::open(['url' => 'admin/zones/'.$zone->id,'method'=>'DELETE','class'=>'form-inline']) !!}
										@can('Edit zones')
										<a href="{{ route('zones.edit',$zone->id) }}" class="btn bg-purple btn-sm btn-flat" title="@lang('equicare.edit')"><i class="fa fa-edit"></i>  </a>
										@endcan &nbsp;
										<input type="hidden" name="id" value="{{ $zone->id }}">
										@can('Delete zones')
										<button class="btn btn-warning btn-sm btn-flat" type="submit" onclick="return confirm('@lang('equicare.are_you_sure')')" title="@lang('equicare.delete')"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
										@endcan
									{!! Form::close() !!}
								</td>
							@endif
						</tr>
						@endforeach
						@endif
						</tbody>
						<tfoot>
							<tr>
								<th> # </th>
								<th>Zona</th>
								<th> Nombre</th>
								<th> Encargado </th>
								@if(Auth::user()->can('Edit zones') || Auth::user()->can('Delete zones'))
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