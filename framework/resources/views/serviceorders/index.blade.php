@extends('layouts.admin')
@section('body-title')
    @lang('Ordenes de Servicio')
@endsection
@section('title')
	| @lang('Ordenes de Servicio')
@endsection
@section('breadcrumb')
<li class="active">@lang('Ordenes de Servicio')</li>
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"> Ordenes de Servicio </h4>
						{{-- @if(Auth::user()->can('Create orders'))
                            <a href="{{ route('orders.create') }}" class="btn btn-primary btn-flat">Agregar</a></h4>
                        @endif --}}
						<a href="{{ route('orders.reportes_pdf') }}" class="btn btn-primary btn-flat">Descargar</a></h4>
				</div>

				<div class="box-body table-responsive">
					<table class="table table-bordered table-hover dataTable bottom-padding" id="data_table">
						<thead class="thead-inverse">
							<tr>
								<th> # </th>
								<th> Orden No.</th>
								<th> Descripcion </th>
								<th> Categoria </th>
								<th> Contacto </th>
								@if(Auth::user()->can('Edit orders') || Auth::user()->can('Delete orders'))
								<th> @lang('equicare.action')</th>
								@endif 
							</tr>
						</thead>
						<tbody>
							@if (isset($orders))
							@php
								$count = 0;
							@endphp
							@foreach ($orders as $order)
							@php
								$count++;
							@endphp
							<tr>
							<td> {{ $count }} </td>
							<td> {{ ucfirst($order->number_id) }} </td>
							<td> {{ $order->ticket->description ?? '-' }}</td>
							<td> {{ $order->ticket->category ?? '-' }}</td>
							<td>{{ $order->ticket->contact ?? '-'}}</td>
							
							@if(Auth::user()->can('Edit orders') || Auth::user()->can('Delete orders'))
								<td>
									{!! Form::open(['url' => 'admin/orders/'.$order->id,'method'=>'DELETE','class'=>'form-inline']) !!}
										{{-- @can('Edit orders')
										<a href="{{ route('orders.edit',$order->id) }}" class="btn bg-purple btn-sm btn-flat" title="@lang('equicare.edit')"><i class="fa fa-edit"></i>  </a>
										@endcan &nbsp;
										<input type="hidden" name="id" value="{{ $order->id }}">
										@can('Delete orders')
										<button class="btn btn-warning btn-sm btn-flat" type="submit" onclick="return confirm('@lang('equicare.are_you_sure')')" title="@lang('equicare.delete')"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
										@endcan --}}
										
										@if($order->status == 1)
											<a href="{{ route('orders.edit',$order->id) }}" class="btn bg-purple btn-sm btn-flat" title="exportar" onclick="return confirm('¿Estás seguro de que quieres exportar este pedido?')">
												<i class="fa fa-check"></i>
											</a>
										@endif

										@if($order->status == 2)
											<a href="{{ route('orders.pdf',$order->id) }}" class="btn bg-purple btn-sm btn-flat" title="exportar"><i class="fa fa-download"></i>  </a>
										@endif

										
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
								<th> Orden No.</th>
								<th> Descripcion </th>
								<th> Categoria </th>
								<th> Contacto </th>
								@if(Auth::user()->can('Edit orders') || Auth::user()->can('Delete orders'))
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