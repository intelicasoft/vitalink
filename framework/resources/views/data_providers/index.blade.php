@extends('layouts.admin')
@section('body-title')
    Proveedores
@endsection
@section('title')
	| Proveedores
@endsection
@section('breadcrumb')
<li class="active">Proveedores</li>
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"> Manejar Proveedores
						@if(Auth::user()->can('Create providers'))
                            <a href="{{ route('providers.create') }}" class="btn btn-primary btn-flat">Agregar</a></h4>
                        @endif
				</div>

				<div class="box-body table-responsive">
					<table class="table table-bordered table-hover dataTable bottom-padding" id="data_table">
						<thead class="thead-inverse">
							<tr>
								<th> # </th>
								<th> @lang('equicare.nombre')</th>
								<th> @lang('equicare.descripcion') </th>
								@if(Auth::user()->can('Edit providers') || Auth::user()->can('Delete providers'))
								<th> @lang('equicare.action')</th>
								@endif 
							</tr>
						</thead>
						<tbody>
							@if (isset($providers))
							@php
								$count = 0;
							@endphp
							@foreach ($providers as $provider)
							@php
								$count++;
							@endphp
							<tr>
							<td> {{ $count }} </td>
							<td> {{ ucfirst($provider->nombre) }} </td>
							<td> {{ $provider->observaciones ?? '-' }}</td>
							
							@if(Auth::user()->can('Edit providers') || Auth::user()->can('Delete providers'))
								<td>
									{!! Form::open(['url' => 'admin/providers/'.$provider->id,'method'=>'DELETE','class'=>'form-inline']) !!}
										@can('Edit providers')
										<a href="{{ route('providers.edit',$provider->id) }}" class="btn bg-purple btn-sm btn-flat" title="@lang('equicare.edit')"><i class="fa fa-edit"></i>  </a>
										@endcan &nbsp;
										<input type="hidden" name="id" value="{{ $provider->id }}">
										@can('Delete providers')
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
								<th> Nombre</th>
								<th> Descripcion </th>
								@if(Auth::user()->can('Edit providers') || Auth::user()->can('Delete providers'))
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