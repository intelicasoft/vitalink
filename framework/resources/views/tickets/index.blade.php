@extends('layouts.admin')
@section('body-title')
    @lang('Tickets')
@endsection
@section('title')
	| @lang('Tickets')
@endsection
@section('breadcrumb')
<li class="active">Tickets</li>
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"> Tickets </h4>
						@if(Auth::user()->can('Create tickets'))
                            <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-flat">Agregar</a></h4>
                        @endif
				</div>

				<div class="box-body table-responsive">
					<table class="table table-bordered table-hover dataTable bottom-padding" id="data_table">
						<thead class="thead-inverse">
							<tr>
								<th> # </th>
								<th> Titulo</th>
								<th> Categoria </th>
								<th> SN. Equipo</th>
								<th> Encargado </th>
								
								<th> Usuario </th>
								<th>Prioridad</th>

								@if(Auth::user()->can('Edit tickets') || Auth::user()->can('Delete tickets'))
								<th> @lang('equicare.action')</th>
								@endif 
							</tr>
						</thead>
						<tbody>
							@if (isset($tickets))
							@php
								$count = 0;
							@endphp
							@foreach ($tickets as $ticket)
							@php
								$count++;
							@endphp
							<tr>
							<td> {{ $count }} </td>
							<td> {{ ucfirst($ticket->title) }} </td>
							<td> {{ $ticket->category ?? '-' }}</td>
							<td> {{ $ticket->equipment->sr_no ?? '-' }}</td>
							<td> {{ $ticket->manager->name ?? '-' }}</td>
							<td> {{ $ticket->user->name ?? '-' }}</td>
							<td>
								@if ($ticket->priority == 1)
									1.- BAJA
								@elseif ($ticket->priority == 2)
									2.- MEDIA
								@elseif ($ticket->priority == 3)
									3.- ALTA
								@else
									-
								@endif
							</td>
							
							@if(Auth::user()->can('Edit tickets') || Auth::user()->can('Delete tickets'))
								<td>
									{!! Form::open(['url' => 'admin/tickets/'.$ticket->id,'method'=>'DELETE','class'=>'form-inline']) !!}
									@if($ticket->status == 1)
										@can('Edit tickets')
										<a href="{{ route('tickets.edit',$ticket->id) }}" class="btn bg-purple btn-sm btn-flat" title="@lang('equicare.edit')"><i class="fa fa-edit"></i>  </a>
										@endcan &nbsp;
										<input type="hidden" name="id" value="{{ $ticket->id }}">
										@can('Delete tickets')
										<button class="btn btn-warning btn-sm btn-flat" type="submit" onclick="return confirm('@lang('equicare.are_you_sure')')" title="@lang('equicare.delete')"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
										@endcan
									{!! Form::close() !!}
									@endif
								</td>
							@endif
						</tr>
						@endforeach
						@endif
						</tbody>
						<tfoot>
							<tr>
								<th> # </th>
								<th> Titulo</th>
								<th> Categoria </th>
								<th> SN. Equipo</th>
								<th> Encargado </th>
								<th> Usuario </th>
								<th>Prioridad</th>
								@if(Auth::user()->can('Edit tickets') || Auth::user()->can('Delete tickets'))
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