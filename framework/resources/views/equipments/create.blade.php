@extends('layouts.admin')
@section('body-title')
	@lang('equicare.equipments')
@endsection
@section('title')
	| @lang('equicare.equipments')
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('admin/equipments') }}">@lang('equicare.equipments') </a></li>
<li class="active">@lang('equicare.create')</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header with-border">
				<h4 class="box-title">@lang('equicare.create_equipments')</h4>
				</div>
				<div class="box-body ">
					@include ('errors.list')
					<form class="form" method="post" action="{{ route('equipments.store') }}">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<div class="row">
						{{-- <div class="form-group col-md-6">
							<label for="name"> @lang('equicare.name') </label>
							<input type="text" name="name" class="form-control"
							value="{{ old('name') }}" />
						</div> --}}
						{{-- <div class="form-group col-md-6">
							<label for="short_name"> @lang('equicare.short_name_eq') </label>
							<input type="text" name="short_name" class="form-control"
							value="{{ old('short_name') }}" />
						</div> --}}
						<div class="form-group col-md-6">
							<label for="company"> @lang('equicare.company') </label>
							<input type="text" name="company" class="form-control"
							value="{{ old('company') }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="sr_no"> @lang('equicare.serial_number') </label>
							<input type="text" name="sr_no" class="form-control"
							value="{{ old('sr_no') }}" />
						</div>
						
						<div class="form-group col-md-6">
							<label for="hospital_id"> @lang('equicare.hospital') </label>
							<select name="hospital_id" id="hospital_id" class="form-control">
								<option value="">---select---</option>
								@if(isset($hospitals))
									@foreach ($hospitals as $hospital)
										<option value="{{ $hospital->id }}"
											data-latitude="{{ $hospital->latitude }}"
											data-longitude="{{ $hospital->longitude }}"
											{{ old('hospital_id') ? 'selected' : '' }}
										>{{ $hospital->name }}</option>
									@endforeach
								@endif
							</select>
							
						</div>

						<div class="form-group col-md-6">
							<label for="accesory_id"> Accesorio de Repuesto </label>
							<select name="accesory_id" class="form-control">
								<option value="">---select---</option>
								@if(isset($accesories))
									@foreach ($accesories as $accesory)
										<option value="{{ $accesory->id }}"
											{{ old('accesory_id')?'selected':'' }}
											>{{ $accesory->nombre }}
										</option>
									@endforeach
								@endif
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="brand_id"> @lang('equicare.brand') </label>
							<select name="brand_id" class="form-control">
								<option value="">---select---</option>
								@if(isset($brands))
									@foreach ($brands as $brand)
										<option value="{{ $brand->id }}"
											{{ old('brand_id')?'selected':'' }}
											>{{ $brand->name }}
										</option>
									@endforeach
								@endif
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="model_id"> @lang('equicare.model') </label>
							<select name="model_id" class="form-control">
								<option value="">---select---</option>
								@if(isset($models))
									@foreach ($models as $model)
										<option value="{{ $model->id }}"
											{{ old('model_id')?'selected':'' }}
											>{{ $model->name }}
										</option>
									@endforeach
								@endif
							</select>
						</div>

						
						<div class="form-group col-md-6">
							<label for="department"> @lang('equicare.department') </label>
							{!! Form::select('department',$departments??[],null,['class'=>'form-control','placeholder'=>'--select--']) !!}
						</div>
						<div class="form-group col-md-6">
							<label for="date_of_purchase"> @lang('equicare.purchase_date') </label>
							<div class="input-group">

								<input type="text" id="date_of_purchase" name="date_of_purchase" class="form-control"
								value="{{ old('date_of_purchase') }}" />
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="order_date"> @lang('equicare.order_date') </label>
							<div class="input-group">

							<input type="text" id="order_date" name="order_date" class="form-control"
							value="{{ old('order_date') }}" />
							<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
							</span>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="date_of_installation"> @lang('equicare.installation_date') </label>
							<div class="input-group">

							<input type="text" id="date_of_installation" name="date_of_installation" class="form-control"
							value="{{ old('date_of_installation') }}" />
							<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
							</span>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="warranty_due_date"> @lang('equicare.warranty_due_date') </label>
							<div class="input-group">

							<input type="text" id="warranty_due_date" name="warranty_due_date" class="form-control"
							value="{{ old('warranty_due_date') }}" />
							<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
							</span>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="service_engineer_no"> @lang('equicare.service_engineer_number')</label>
							<input type="text" name="service_engineer_no" class="form-control phone"
							value="{{ old('service_engineer_no') }}" />
						</div>

						{{-- <div class="form-group col-md-6">
							<label> @lang('equicare.critical') </label><br/>
							<label>
							<input type="radio" value="1" name="is_critical" @if(old('is_critical') == '1') checked @endif>
							@lang('equicare.yes')	</label> &nbsp;
							<label>
							<input type="radio" value="0" name="is_critical" @if(old('is_critical') == '0') checked @endif @if(!old('is_critical')) checked @endif>
							@lang('equicare.no')
							</label>
						</div> --}}
						
						<div class="form-group col-md-6">
							<label for="notes"> @lang('equicare.notes') </label>
							<textarea rows="2" name="notes" class="form-control"
							>{{ old('notes') }}</textarea>
						</div>
						<input type="hidden" name="qr_id" value="{{request('qr_id')}}"/>	
						
						{{-- <div class="form-group col-md-12">
							<div id="map" style="width: 100%; height: 400px;"></div>
						</div> --}}
						
						<input type="hidden" name="latitude" id="latitude" value="{{ old('latitude' ,'20.644584169156285') }}">
						<input type="hidden" name="longitude" id="longitude" value="{{ old('longitude','-103.33724912940228') }}">


						<div class="form-group col-md-12">
							<input type="submit" value="@lang('equicare.submit')" class="btn btn-primary btn-flat"/>
						</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#date_of_purchase').datepicker({
				format:"{{ env('date_settings') == '' ? 'yyyy-mm-dd' : env('date_settings') }}",
				'todayHighlight' : true,
			});
			$('#order_date').datepicker({
				format:"{{ env('date_settings') == '' ? 'yyyy-mm-dd' : env('date_settings') }}",
				'todayHighlight' : true,
			});
			$('#date_of_installation').datepicker({
				format:"{{ env('date_settings') == '' ? 'yyyy-mm-dd' : env('date_settings') }}",
				'todayHighlight' : true,
			});
			$('#warranty_due_date').datepicker({
				format:"{{ env('date_settings') == '' ? 'yyyy-mm-dd' : env('date_settings') }}",
				'todayHighlight' : true,
			});

			$('#hospital_id').change(function(){
				var selectedOption = $(this).find('option:selected');
				var latitude = selectedOption.data('latitude');
				var longitude = selectedOption.data('longitude');

				$('#latitude').val(latitude);
				$('#longitude').val(longitude);
				console.log(latitude, longitude);
			});
		});
	</script>


	{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMCnFrl_hkFXPXNj3ksPb_fkygp_HNOh8&callback=initMap" async defer></script>
	<script>
		function initMap() {
			var initialLocation = { lat: 20.659698, lng: -103.349609 }; // Ubicación inicial

			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 8,
				center: initialLocation
			});
			var marker = new google.maps.Marker({
				position: initialLocation,
				map: map,
				draggable: true
			});

			google.maps.event.addListener(marker, 'dragend', function (event) {
				document.getElementById('latitude').value = event.latLng.lat();
				document.getElementById('longitude').value = event.latLng.lng();
			});

			google.maps.event.addListener(map, 'click', function (event) {
				marker.setPosition(event.latLng);
				document.getElementById('latitude').value = event.latLng.lat();
				document.getElementById('longitude').value = event.latLng.lng();
			});
		}
	</script> --}}
@endsection