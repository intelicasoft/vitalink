@extends('layouts.admin')
@section('body-title')
	Modelos
@endsection
@section('title')
	| Modelos
@endsection
@section('breadcrumb')
<li class="active">Modelos</li>
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"> Manejar Modelos
						@if(Auth::user()->can('Create models'))
                            <a href="{{ route('models.create') }}" class="btn btn-primary btn-flat">Agregar</a></h4>
                        @endif
				</div>

				<div class="box-body table-responsive">
					<table class="table table-bordered table-hover dataTable bottom-padding" id="data_table">
						<thead class="thead-inverse">
							<tr>
								<th> # </th>
								<th> @lang('equicare.nombre')</th>
								<th> Marca </th>
								<th> @lang('equicare.descripcion') </th>
								@if(Auth::user()->can('Edit models') || Auth::user()->can('Delete models'))
								<th> @lang('equicare.action')</th>
								@endif 
							</tr>
						</thead>
						<tbody>
							@if (isset($models))
							@php
								$count = 0;
							@endphp
							@foreach ($models as $model)
							@php
								$count++;
							@endphp
							<tr>
							<td> {{ $count }} </td>
							<td> {{ ucfirst($model->name) }} </td>
							<td> {{ $model->brand->name ?? '-' }}</td>
							<td> {{ $model->description ?? '-' }}</td>
							
							@if(Auth::user()->can('Edit models') || Auth::user()->can('Delete models'))
								<td>
									{!! Form::open(['url' => 'admin/models/'.$model->id,'method'=>'DELETE','class'=>'form-inline']) !!}
										@can('Edit models')
										<a href="{{ route('models.edit',$model->id) }}" class="btn bg-purple btn-sm btn-flat" title="@lang('equicare.edit')"><i class="fa fa-edit"></i>  </a>
										@endcan &nbsp;
										<input type="hidden" name="id" value="{{ $model->id }}">
										@can('Delete models')
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
								<th> Marca </th>
								<th> Descripcion </th>
								@if(Auth::user()->can('Edit models') || Auth::user()->can('Delete models'))
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