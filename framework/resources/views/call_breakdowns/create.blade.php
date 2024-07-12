@extends('layouts.admin')
@section('body-title')
@lang('equicare.call_entries')
@endsection
@section('title')
| @lang('equicare.breakdown_maintenance_call_entry')
@endsection
@section('breadcrumb')
<li>
	<a href="{{ url('admin/call/breakdown_maintenance') }}">
		@lang('equicare.breakdown_maintenance')
	</a>
</li>
<li class="active">@lang('equicare.create')</li>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title">@lang('equicare.create_breakdown_maintenance')</h4>
			</div>
			<div class="box-body">
				@include ('errors.list')
				<div class="row">
					<div class="form-group col-md-4">
						<label for="sr_no"> @lang('equicare.serial_number') </label>
						<select id="sr_no" name="sr_no" class="form-control select2">
							<option value="">Equipo clínico</option>
							@if(isset($equipments))
								@foreach ($equipments as $equipment)
									<option value="{{ $equipment->sr_no }}" data-model="{{ $equipment->models->name ?? "Sin modelo"}}" {{ old('sr_no') == $equipment->sr_no ? 'selected' : '' }}>
										{{ $equipment->sr_no }}
									</option>
								@endforeach
							@endif
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="hospital"> @lang('equicare.hospital') </label>
						<input type="text" name="hospital" class="hospital form-control" value="" disabled />
					</div>
					<div class="form-group col-md-4">
						<label for="department"> @lang('equicare.department') </label>
						<input type="text" name="department" class="department form-control" value="" disabled />
					</div>
					<div class="form-group col-md-4">
						<label for="unique_id"> @lang('equicare.unique_id') </label>
						<input type="text" name="unique_id" class="unique_id form-control" value="" disabled />
					</div>
					<div class="form-group col-md-4">
						<label for="equip_name"> @lang('equicare.equipment_name') </label>
						<input type="text" name="equip_name" class="equip_name form-control" value="" disabled />
					</div>
					<div class="form-group col-md-4">
						<label for="company"> @lang('equicare.company') </label>
						<input type="text" name="company" class="company form-control" value="" disabled />
					</div>
					<div class="form-group col-md-4">
						<label for="model"> @lang('equicare.model') </label>
						<input type="text" name="model" class="model form-control" value="" disabled />
					</div>
				</div>
			</div>
			<div class="box-body">
				<form class="form" method="post" action="{{ route('breakdown_maintenance.store') }}">
					{{ csrf_field() }}
					{{ method_field('POST') }}
					<div class="row">
						
						<div class="form-group col-md-4 report_no none-display">
							<label for="department"> @lang('equicare.report_number') </label>
							<input type="text" name="report_no" class="form-control" value="" />
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label for="call_register_date_time"> @lang('equicare.call_registration_date_time') </label>
							<div class="input-group">
								<input type="text" name="call_register_date_time" class="form-control call_register_date_time" value="" />
								<span class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</span>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label>@lang('equicare.working_status')</label>
							{!! Form::select('working_status',[
							'working' => __("equicare.working"),
							'not working' => __("equicare.not_working"),
							'pending' => __("equicare.pending")
							],null,['placeholder' => '--select--','class' => 'form-control']) !!}
						</div>
						<div class="form-group col-md-4">
							<label>@lang('equicare.nature_of_problem')</label>
							{!! Form::textarea('nature_of_problem',null,['rows' => 2, 'class' => 'form-control']) !!}
						</div>
						<div class="form-group col-md-12">
							<input type="hidden" name="equip_id" id="equip_id" value="{{old('equip_id')}}" />
							<input type="hidden" name="hospital_id" id="hospital_id" value="{{old('hospital_id')}}" />
							<input type="hidden" name="department_id" id="department_id" value="{{old('department_id')}}" />
							<input type="submit" value="@lang('equicare.submit')" class="btn btn-primary btn-flat">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/datetimepicker.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: '{{__("equicare.select_option")}}',
			allowClear: true
		});
		
		function updateModel() {
            var selectedOption = $('#sr_no').find('option:selected');
            var model = selectedOption.data('model') || ''; // Default to empty string if no model found
            $('#model').val(model);
        }

		updateModel();

		$('#equipment_id').on('change', function() {
            updateModel();
        });

		$('#sr_no').on('change', function(){
			var value = $(this).val();
			var equip_name = $('.equip_name');
			var hospital = $('.hospital');
			var department = $('.department');
			var unique_id = $('.unique_id');
			var company = $('.company');
			var model = $('.model');

			if(value == ""){
				equip_name.val("");
				hospital.val("");
				department.val("");
				unique_id.val("");
				company.val("");
				model.val("");
			}

			if(value != ""){
				$.ajax({
					url: "{{ url('serial_number_breakdown') }}",
					type: 'get',
					data: {'sr_no': value},
					success: function(data){
						if(data.success){
							equip_name.val(data.success.name);
							hospital.val(data.success.hospital_name);
							department.val(data.success.department_name);
							unique_id.val(data.success.unique_id);
							company.val(data.success.company);
							model.val(data.success.model);

							new PNotify({
								title: 'Correcto!',
								text: "{{__('equicare.equipment_data_fetched')}}",
								type: 'success',
								delay: 3000,
								nonblock: {
									nonblock: true
								}
							});
						} else {
							new PNotify({
								title: 'Error!',
								text: "{{__('equicare.equipment_data_not_found')}}",
								type: 'error',
								delay: 3000,
								nonblock: {
									nonblock: true
								}
							});
						}
					}
				});
			}
		});
	});
	$('.call_register_date_time').datetimepicker({
		sideBySide: true,
	});
</script>
<script type="text/javascript">
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection
@section('styles')
<link rel="stylesheet" type="text/css"
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
@endsection
