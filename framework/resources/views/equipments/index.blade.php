@extends('layouts.admin')
@section('body-title')
@lang('equicare.equipments')
@endsection
@section('title')
| @lang('equicare.equipments')
@endsection
@section('breadcrumb')
<li class="active">@lang('equicare.equipments')</li>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h4 class="box-title">@lang('equicare.filters')</h4>
			</div>
			<div class="box-body">
				<form method="get" class="form" action="{{ route('equipments.index') }}">
					<div class="row">
						<div class="form-group col-md-3">
							<label>@lang('equicare.hospital'): </label>
							<select name="hospital_id" class="form-control">
								<option value="">@lang('equicare.select')</option>
								@if(isset($hospitals))
								@foreach ($hospitals as $hospital)
								<option value="{{ $hospital->id }}"
									@if(isset($hospital_id) && $hospital_id==$hospital->id)
									selected
									@endif
									>
									{{ ucfirst($hospital->name) }}
								</option>
								@endforeach
								@endif
							</select>
						</div>
						<div class="form-group col-md-3">
							<label>@lang('equicare.company'): </label>
							<select name="company" class="form-control">
								<option value="">@lang('equicare.select')</option>
								@if(isset($companies))
								@foreach ($companies as $company)
								<option value="{{ $company->company }}"
									@if(isset($companyy) && $companyy==$company->company)
									selected
									@endif
									>
									{{ ucfirst($company->company) }}
								</option>
								@endforeach
								@endif
							</select>
						</div>
						<div class="form-group col-md-2">
							<label class="visibility">123</label>
							<input type="submit" value="excel" id="excel_hidden" name="excel_hidden" class="hidden"/>
							<input type="submit" value="pdf" id="pdf_hidden" name="pdf_hidden" class="hidden"/>
							<input type="submit" value="@lang('equicare.submit')" class="btn btn-primary btn-flat form-control" />
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header with-border">
				<h4 class="box-title">@lang('equicare.manage_equipments')
					@if (\Auth::user()->hasDirectPermission('Create Equipments'))
					<a href="{{ route('equipments.create') }}" class="btn btn-primary btn-flat">@lang('equicare.add_new')</a></h4>
					@endif
					<div class="export-btns">
					{!! Form::label('excel_hidden',__('equicare.export_excel'),['class' => 'btn btn-success btn-flat excel','name'=>'action','tabindex'=>1]) !!}
					{!! Form::label('pdf_hidden',__('equicare.export_pdf'),['class' => 'btn btn-primary btn-flat pdf','name'=>'action','tabindex'=>2]) !!}
					</div>
				</div>
				<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover dataTable bottom-padding" id="data_table_equipment">
						<thead class="thead-inverse">
							<tr>
								<th> # </th>
								<th> @lang('equicare.qr_code') </th>
								<th> @lang('equicare.user') </th>
								<th> @lang('equicare.company') </th>
								<th> @lang('equicare.model') </th>
								<th> @lang('equicare.hospital') </th>
								<th> Accesorio de Repuesto</th>
								<th> Marca </th>
								<th> @lang('equicare.serial_no') </th>
								{{-- <th> @lang('equicare.department') </th> --}}
								<th> @lang('equicare.purchase_date') </th>
								<th> @lang('equicare.order_date') </th>
								<th> @lang('equicare.installation_date') </th>
								<th> @lang('equicare.warranty_date') </th>
								@if(Auth::user()->hasDirectPermission('Edit Equipments') || Auth::user()->hasDirectPermission('Delete Equipments'))
								<th> @lang('equicare.action') </th>
								@endif
							</tr>
						</thead>
						<tbody>
							@if (isset($equipments))
							{{-- @dd($equipments) --}}
							@foreach ($equipments as $key => $equipment)
							<tr style="{{ $equipment->status == 5 ? 'background-color: #a9a9a9;' : '' }}">
								<td> {{ $key+1 }} </td>
								@php
								// dd( (\App\QrGenerate::where('id',$equipment->qr_id)->first() !=null) ? (\App\QrGenerate::where('id',$equipment->qr_id)->first()->uid) : '');
								// \App\Equipment::select('*')->delete();
								$u_e_id = (\App\QrGenerate::where('id',$equipment->qr_id)->first() !=null ? (\App\QrGenerate::where('id',$equipment->qr_id)->first()->uid) : '')
								@endphp
								<td><img loading="lazy" src="{{ asset('/uploads/qrcodes/qr_assign/'.$u_e_id.'.png') }}" width="80px" /></td>
								<td>{{ $equipment->user?ucfirst($equipment->user->name):'-' }}</td>
								<td>{{ $equipment->company?? '-' }}</td>
								<td>{{ $equipment->models->name ?? '-' }}</td>
								<td>{{ $equipment->hospital?$equipment->hospital->name:'-' }}</td>
								<td>{{ $equipment->accesory_id ?? '-' }}</td>
								<td>{{ $equipment->brand->name ?? '-' }}</td>
								<td>{{ $equipment->sr_no }}</td>
								{{-- {{dd($equipment->get_department)}} --}}
								{{-- <td>{{($equipment->get_department->short_name)??"-" }} ({{ ($equipment->get_department->name) ??'-' }})</td>
								@php
									$uids = explode('/',$equipment->unique_id);
									$department_id = $uids[1];
									$department = \App\Department::withTrashed()->find($department_id);
									if (!is_null($department)) {
										$uids[1] = $department->short_name;
									}
									$uids = implode('/',$uids);
								@endphp --}}
								{{-- <td>{{ $uids }}</td> --}}
								<td>{{ date_change($equipment->date_of_purchase)?? '-' }}</td>
								<td>{{ date_change($equipment->order_date)?? '-' }}</td>
								<td>{{ date_change($equipment->date_of_installation)??'-' }}</td>
								<td>{{ date_change($equipment->warranty_due_date)??'-' }}</td>
								@if(Auth::user()->hasDirectPermission('Edit Equipments') || Auth::user()->hasDirectPermission('Delete Equipments'))
								<td class="text-nowrap">
									{!! Form::open(['url' => 'admin/equipments/'.$equipment->id,'method'=>'DELETE','class'=>'form-inline']) !!}
									@if(Auth::user()->hasDirectPermission('Edit Equipments'))
									<a href="{{ route('equipments.edit',$equipment->id) }}" class="btn bg-purple btn-sm btn-flat marginbottom" title="@lang('equicare.edit')"><i class="fa fa-edit"></i></a>
									@endif
									<a target="_blank" href="{{ route('equipments.history',$equipment->id) }}" class="btn bg-success btn-sm btn-flat marginbottom" title="@lang('equicare.history')"><i class="fa fa-history"></i></a>
									@php
									// \App\Equipment::select('*')->delete();
									$u_e_id = (\App\QrGenerate::where('id',$equipment->qr_id)->first() !=null ? (\App\QrGenerate::where('id',$equipment->qr_id)->first()->uid) : '')

									@endphp
									<a href="#" class="btn bg-success btn-sm btn-flat marginbottom" title="@lang('equicare.qr_code')" data-uniqueid="{{$equipment->unique_id}}" data-url="{{ asset('uploads/qrcodes/qr_assign/'.$u_e_id.'.png') }}" data-toggle="modal" data-target="#qr-modal"><i class="fa fa-qrcode"></i></a>
									<input type="hidden" name="id" value="{{ $equipment->id }}">
									@if(Auth::user()->hasDirectPermission('Delete Equipments'))
									<button class="btn btn-warning btn-sm btn-flat marginbottom" type="submit" onclick="return confirm('@lang('equicare.are_you_sure')')" title="@lang('equicare.delete')"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
									@endif
									{!! Form::close() !!}
									<a href="{{ route('equipments.etiqueta',$equipment->id) }}" class="btn bg-purple btn-sm btn-flat marginbottom fa fa-download"></a>
								</td>
								@endif

								@endforeach
								@endif
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th> # </th>
								<th> @lang('equicare.qr_code') </th>
								<th> @lang('equicare.user') </th>
								<th> @lang('equicare.company') </th>
								<th> @lang('equicare.model') </th>
								<th> @lang('equicare.hospital') </th>
								<th> Accesorio de Repuesto</th>
								<th> Marca </th>
								<th> @lang('equicare.serial_no') </th>
								{{-- <th> @lang('equicare.department') </th> --}}
								<th> @lang('equicare.purchase_date') </th>
								<th> @lang('equicare.order_date') </th>
								<th> @lang('equicare.installation_date') </th>
								<th> @lang('equicare.warranty_date') </th>
								@if(Auth::user()->hasDirectPermission('Edit Equipments') || Auth::user()->hasDirectPermission('Delete Equipments'))
								<th> @lang('equicare.action') </th>
								@endif
							</tr>
						</tfoot>
					</table>
				</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
	@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('#data_table_equipment').DataTable();
			$('#qr-modal').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget);
				var modal = $(this)
				modal.find('#qr-modal-iframe').attr('src','#');
				modal.find('.modal-title').html('QR Code for <strong>'+button.data('uniqueid')+'</strong>');
				modal.find('#qr-image').attr('src', button.data('url'));
			})
		} );
	</script>
	@endsection
	@section('styles')
	<style type="text/css">
	#data_table_equipment{
		border-collapse: collapse !important;
	}
	.export-btns{
		display: inline-block;
		float: right;
	}
	</style>
<div class="modal fade" id="qr-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<div class="text-center">
        <!-- <iframe id="qr-modal-iframe" src="" width="100%" height="170" style="border:0; overflow:hidden;"></iframe> -->
        <img id="qr-image" src="" alt=""/>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection