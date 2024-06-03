@extends('layouts.admin')
@section('body-title')
    @lang('equicare.accesorios')
@endsection
@section('title')
	| @lang('equicare.accesorios')
@endsection
@section('breadcrumb')
<li class="active">@lang('equicare.accesorios')</li>
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"> Manejar Accesorios
						@if(Auth::user()->can('Create accesories'))
                            <a href="{{ route('accesories.create') }}" class="btn btn-primary btn-flat">Agregar</a></h4>
                        @endif
				</div>

				<div class="box-body table-responsive">
					<table class="table table-bordered table-hover dataTable bottom-padding" id="data_table">
						<thead class="thead-inverse">
							<tr>
								<th> # </th>
								<th> nombre</th>
								<th> Lote </th>
								<th> Proveedor </th>
								<th> Catalogo </th>
								<th> Inventario </th>
								<th> Costo </th>
								<th> Observaciones </th>
								@if(Auth::user()->can('Edit accesories') || Auth::user()->can('Delete accesories'))
								<th> @lang('equicare.action')</th>
								@endif 
							</tr>
						</thead>
						<tbody>
							@if (isset($accesories))
							@php
								$count = 0;
							@endphp
							@foreach ($accesories as $accesory)
							@php
								$count++;
							@endphp
							<tr>
							<td> {{ $count }} </td>
							<td> {{ ucfirst($accesory->nombre) }} </td>
							<td> {{ $accesory->lote->nlote ?? '-' }}</td>
							<td> {{ $accesory->proveedor->nombre ?? '-' }}</td>
							<td> {{ $accesory->catalogo ?? '-' }}</td>
							<td> {{ $accesory->inventario ?? '-' }}</td>
							<td> {{ $accesory->costo ?? '-' }}</td>
							<td> {{ $accesory->observaciones ?? '-' }}</td>
							
							@if(Auth::user()->can('Edit accesories') || Auth::user()->can('Delete accesories'))
								<td>
									{!! Form::open(['url' => 'admin/accesories/'.$accesory->id,'method'=>'DELETE','class'=>'form-inline']) !!}
										@can('Edit accesories')
										<a href="{{ route('accesories.edit',$accesory->id) }}" class="btn bg-purple btn-sm btn-flat" title="@lang('equicare.edit')"><i class="fa fa-edit"></i>  </a>
										@endcan &nbsp;
										<input type="hidden" name="id" value="{{ $accesory->id }}">
										@can('Delete accesories')
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
								<th> nombre</th>
								<th> Lote </th>
								<th> Proveedor </th>
								<th> Catalogo </th>
								<th> Inventario </th>
								<th> Costo </th>
								<th> Observaciones </th>
								@if(Auth::user()->can('Edit accesories') || Auth::user()->can('Delete accesories'))
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