@extends('layouts.admin')
@section('body-title')
    @lang('equicare.marcas')
@endsection
@section('title')
	| @lang('equicare.marcas')
@endsection
@section('breadcrumb')
<li class="active">Marcas</li>
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"> Manejar Marcas
						@can('Create brands')
                            <a href="{{ route('brands.create') }}" class="btn btn-primary btn-flat">Agregar</a></h4>
                        @endcan
						<a href="{{ route('brands.create') }}" class="btn btn-primary btn-flat">Agregar</a></h4>
				</div>

				<div class="box-body table-responsive">
					<table class="table table-bordered table-hover dataTable bottom-padding" id="data_table">
						<thead class="thead-inverse">
							<tr>
								<th> # </th>
								<th> @lang('equicare.nombre')</th>
								<th> Tipo de Marca </th>
								<th> @lang('equicare.descripcion') </th>
								{{-- @if(Auth::user()->can('Edit brands') || Auth::user()->can('Delete Hospitals'))
								<th> @lang('equicare.action')</th>
								@endif --}}
                                <th> @lang('equicare.action')</th>
							</tr>
						</thead>
						<tbody>
							@if (isset($brands))
							@php
								$count = 0;
							@endphp
							@foreach ($brands as $brand)
							@php
								$count++;
							@endphp
							<tr>
							<td> {{ $count }} </td>
							<td> {{ ucfirst($brand->name) }} </td>
							<td> {{ $brand->type ?? '-' }}</td>
							<td> {{ $brand->description ?? '-' }}</td>
							
							{{-- @if(Auth::user()->can('Edit Hospitals') || Auth::user()->can('Delete Hospitals'))
                        	<td>
								{!! Form::open(['url' => 'admin/hospitals/'.$hospital->id,'method'=>'DELETE','class'=>'form-inline']) !!}
									@can('Edit Hospitals')
									<a href="{{ route('hospitals.edit',$hospital->id) }}" class="btn bg-purple btn-sm btn-flat" title="@lang('equicare.edit')"><i class="fa fa-edit"></i>  </a>
									@endcan &nbsp;
		                            <input type="hidden" name="id" value="{{ $hospital->id }}">
		                            @can('Delete Hospitals')
		                            <button class="btn btn-warning btn-sm btn-flat" type="submit" onclick="return confirm('@lang('equicare.are_you_sure')')" title="@lang('equicare.delete')"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
		                            @endcan
		                        {!! Form::close() !!}
							</td>
							@endif --}}
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
								@if(Auth::user()->can('Edit Brands') || Auth::user()->can('Delete Brands'))
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