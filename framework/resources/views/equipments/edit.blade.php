@extends('layouts.admin')
@section('body-title')
	@lang('equicare.equipments')
@endsection
@section('title')
	| @lang('equicare.equipments')
@endsection
@section('breadcrumb')
<li><a href="{{ url('admin/equipments') }}">@lang('equicare.equipments') </a></li>
<li class="active">@lang('equicare.edit')</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary ">
			<div class="box-header with-border">
				<h4 class="box-title">@lang('equicare.edit_equipments')</h4>
				</div>
				<div class="box-body ">
					@include ('errors.list')
					<form class="form" method="post" action="{{ route('equipments.update',$equipment->id) }}">
						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						<div class="row">
						{{-- <div class="form-group col-md-6">
							<label for="name"> @lang('equicare.name') </label>
							<input type="text" name="name" class="form-control"
							value="{{ $equipment->name }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="short_name"> @lang('equicare.short_name_eq') </label>
							<input type="text" name="short_name" class="form-control"
							value="{{ $equipment->short_name }}" />
						</div> --}}
						<div class="form-group col-md-6">
							<label for="company"> @lang('equicare.company') </label>
							<input type="text" name="company" class="form-control"
							value="{{ $equipment->company }}" />
						</div>
						{{-- <div class="form-group col-md-6">
							<label for="model"> @lang('equicare.model') </label>
							<input type="text" name="model" class="form-control"
							value="{{ $equipment->model }}" />
						</div> --}}
						<div class="form-group col-md-6">
							<label for="sr_no"> @lang('equicare.serial_number') </label>
							<input type="text" name="sr_no" class="form-control"
							value="{{ old('sr_no')??$equipment->sr_no }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="hospital_id"> @lang('equicare.hospital') </label>
							<select name="hospital_id" class="form-control">
								<option value="">---select---</option>
								@if(isset($hospitals))
									@foreach ($hospitals as $hospital)
										<option value="{{ $hospital->id }}"
											{{ $hospital->id==$equipment->hospital_id?'selected':''}}
											>{{ $hospital->name }}
										</option>
									@endforeach
								@endif
							</select>
						</div>
						
						<div class="form-group col-md-6">
							<label for="brand_id"> Marca </label>
							<select name="brand_id" class="form-control">
								<option value="">---select---</option>
								@if(isset($brands))
									@foreach ($brands as $brand)
										<option value="{{ $brand->id }}"
											{{ $brand->id==$equipment->brand_id?'selected':''}}
											>{{ $brand->name }}
										</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="accesory_id"> @lang('equicare.spare_accessory') </label>
							<select name="accesory_id" class="form-control">
								<option value="">---select---</option>
								@if(isset($accesories))
									@foreach ($accesories as $accesory)
										<option value="{{ $accesory->id }}"
											{{ $accesory->id==$equipment->accesory_id?'selected':''}}
											>{{ $accesory->nombre }}
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
											{{ $model->id==$equipment->model_id?'selected':''}}
											>{{ $model->name }}
										</option>
									@endforeach
								@endif
							</select>
						</div>

						{{-- <div class="form-group col-md-6">
							<label for="department"> @lang('equicare.department') </label>
							{!! Form::select('department',$departments??[],$equipment->department??null,['class'=>'form-control','placeholder'=>'--select--']) !!}
						</div> --}}
						<div class="form-group col-md-6">
							<label for="date_of_purchase"> @lang('equicare.purchase_date') </label>
							
							<div class="input-group">
{{-- @dd($equipment->date_of_purchase,env('date_settings')) --}}
								<input type="text" id="date_of_purchase" name="date_of_purchase" class="form-control"			
								value="{{date_change($equipment->date_of_purchase)}}" />
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="order_date"> @lang('equicare.order_date') </label>
							<div class="input-group">

							<input type="text" id="order_date" name="order_date" class="form-control"
							value="{{ date_change($equipment->order_date) }}" />
							<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
							</span>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="date_of_installation"> @lang('equicare.installation_date') </label>
							<div class="input-group">

							<input type="text" id="date_of_installation" name="date_of_installation" class="form-control"
							value="{{ date_change($equipment->date_of_installation) }}" />
							<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
							</span>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="warranty_due_date"> @lang('equicare.warranty_due_date') </label>
							<div class="input-group">

							<input type="text" id="warranty_due_date" name="warranty_due_date" class="form-control"
							value="{{ date_change($equipment->warranty_due_date) }}" />
							<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
							</span>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="service_engineer_no"> @lang('equicare.service_engineer_number') </label>
							<input type="text" name="service_engineer_no" class="form-control phone"
							value="{{ $equipment->service_engineer_no }}" />
						</div>
						
						{{-- <div class="form-group col-md-6">
							<label> @lang('equicare.critical') </label><br/>
							<label>
							<input type="radio" value="1" name="is_critical" {{ $equipment->is_critical==1? 'checked':'' }}>
							@lang('equicare.yes')	</label> &nbsp;
							<label>
							<input type="radio" value="0" name="is_critical" {{ $equipment->is_critical==0? 'checked':''  }}>
							@lang('equicare.no')
							</label>
						</div> --}}

						<div class="form-group col-md-6">
							<label for="notes"> @lang('equicare.notes') </label>
							<textarea rows="2" name="notes" class="form-control"
							>{{ $equipment->notes }}</textarea>
						</div>

						<div class="form-group col-md-6">
							<label for="last_id"> Anterior ID</label>
							<input type="number" name="last_id" class="form-control"
							value="{{ $equipment->last_id}}" />
						</div>

						<div class="form-group col-md-12">
							<div id="map" style="width: 100%; height: 400px;"></div>
						</div>
						<input type="hidden" name="latitude" id="latitude" value="{{ $equipment->latitude }}">
						<input type="hidden" name="longitude" id="longitude" value="{{ $equipment->longitude }}">

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
				format:"{{env('date_settings')=='' ? 'yyyy-mm-dd' : env('date_settings')}}",
				'todayHighlight' : true,
			});
			$('#order_date').datepicker({
				format:"{{env('date_settings')=='' ? 'yyyy-mm-dd' : env('date_settings')}}",
				'todayHighlight' : true,
			});
			$('#date_of_installation').datepicker({
				format:"{{env('date_settings')=='' ? 'yyyy-mm-dd' : env('date_settings')}}",
				'todayHighlight' : true,
			});
			$('#warranty_due_date').datepicker({
				format:"{{env('date_settings')=='' ? 'yyyy-mm-dd' : env('date_settings')}}",
				'todayHighlight' : true,
			});
		});
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMCnFrl_hkFXPXNj3ksPb_fkygp_HNOh8&callback=initMap" async defer></script>
	<script>
		function initMap() {
			var initialLocation;

			// Verificar si hay datos en equipment
			@if(isset($equipment) && !empty($equipment->latitude) && !empty($equipment->longitude))
				initialLocation = { lat: parseFloat('{{ $equipment->latitude }}'), lng: parseFloat('{{ $equipment->longitude }}') };
			@else
				initialLocation = { lat: 20.659698, lng: -103.349609 }; // Ubicación inicial predeterminada
			@endif

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
	</script>
@endsection