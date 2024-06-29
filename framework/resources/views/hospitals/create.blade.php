@extends('layouts.admin')
@section('body-title')
@lang('equicare.hospitals')
@endsection
@section('title')
	| @lang('equicare.hospitals')
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('admin/hospitals') }}">@lang('equicare.hospitals') </a></li>
<li class="active">@lang('equicare.create')</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title">@lang('equicare.create_hospital')</h4>
				</div>

				<div class="box-body ">
					@include ('errors.list')
					<form class="form" method="post" action="{{ route('hospitals.store') }}">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<div class="row">
						<div class="form-group col-md-6">
							<label for="name"> @lang('equicare.name') </label>
							<input type="text" name="name" class="form-control"
							value="{{ old('name') }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="slug"> @lang('equicare.Short Name') </label>
							<input type="text" name="slug" class="form-control"
							value="{{ old('slug') }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="email"> @lang('equicare.email') </label>
							<input type="email" name="email" class="form-control" value="{{ old('email') }}"/>
						</div>
						<div class="form-group col-md-6">
							<label for="contact_person"> @lang('equicare.contact_person') </label>
							<input type="text" name="contact_person" class="form-control"
							value="{{ old('contact_person') }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="phone_no"> @lang('equicare.phone') </label>
							<input type="text" name="phone_no" class="form-control phone"
							value="{{ old('phone_no') }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="mobile_no"> @lang('equicare.mobile') </label>
							<input type="text" name="mobile_no" class="form-control phone"
							value="{{ old('mobile_no') }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="address"> @lang('equicare.address') </label>
							<textarea rows="3" name="address" class="form-control"
							>{{ old('address') }}</textarea>
						</div>

						<div class="form-group col-md-12">
							<div id="map" style="width: 100%; height: 400px;"></div>
						</div>
						
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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMCnFrl_hkFXPXNj3ksPb_fkygp_HNOh8&callback=initMap" async defer></script>
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
	</script>
@endsection