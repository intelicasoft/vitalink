@extends('layouts.admin')
@section('body-title')
Lotes
@endsection
@section('title')
	| Lotes
@endsection
@section('breadcrumb')
<li class="active">Lotes</li>
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"> Manejar Lotes
						@if(Auth::user()->can('Create lots'))
                            <a href="{{ route('lots.create') }}" class="btn btn-primary btn-flat">Agregar</a></h4>
                        @endif
				</div>

				<div class="box-body table-responsive">
					<table class="table table-bordered table-hover dataTable bottom-padding" id="data_table">
						<thead class="thead-inverse">
							<tr>
								<th> # </th>
								<th> Numero de lote</th>
								<th> Nivel </th>
								<th>Marca </th>
								<th>Fecha de fabricación</th>
								<th>Fecha de expiración </th>
								<th>Observaciones </th>
								@if(Auth::user()->can('Edit lots') || Auth::user()->can('Delete lots'))
								<th> @lang('equicare.action')</th>
								@endif 
							</tr>
						</thead>
						<tbody>
							@if (isset($lots))
							@php
								$count = 0;
							@endphp
							@foreach ($lots as $lot)
							@php
								$count++;
							@endphp
							<tr>
							<td> {{ $count }} </td>
							<td> {{ ucfirst($lot->nlote) }} </td>
							<td> {{ $lot->nivel ?? '-' }}</td>
							<td> {{ $lot->marca->name ?? '-' }}</td>
							<td> {{ $lot->fabricacion ?? '-' }}</td>
							<td> {{ $lot->expiracion ?? '-' }}</td>
							<td> {{ $lot->observaciones ?? '-' }}</td>
							
							@if(Auth::user()->can('Edit lots') || Auth::user()->can('Delete lots'))
								<td>
									{!! Form::open(['url' => 'admin/lots/'.$lot->id,'method'=>'DELETE','class'=>'form-inline']) !!}
										@can('Edit lots')
										<a href="{{ route('lots.edit',$lot->id) }}" class="btn bg-purple btn-sm btn-flat" title="@lang('equicare.edit')"><i class="fa fa-edit"></i>  </a>
										@endcan &nbsp;
										<input type="hidden" name="id" value="{{ $lot->id }}">
										@can('Delete lots')
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
								<th> Numero de lote</th>
								<th> Nivel </th>
								<th>Marca </th>
								<th>Fecha de fabricación</th>
								<th>Fecha de expiración </th>
								<th>Observaciones </th>
								@if(Auth::user()->can('Edit lots') || Auth::user()->can('Delete lots'))
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