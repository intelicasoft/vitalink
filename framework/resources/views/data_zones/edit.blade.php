@extends('layouts.admin')
@section('body-title')
    @lang('Zonas')
@endsection
@section('title')
	| @lang('Zonas')
@endsection
@section('breadcrumb')
<li class="active">Zonas</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

                <div class="box-header with-border">
                    <h4 class="box-title">
                        @lang('equicare.edit_datazone')
                    </h4>
                </div>
                <div class="box-body">
					@include ('errors.list')
                    <form class="form" method="post" action="{{ route('zones.update',$zone->id) }}">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="PATCH"/>
						<div class="row">
						<div class="form-group col-md-6">
							<label for="name"> @lang('equicare.name') </label>
							<input type="text" name="name" class="form-control"
							value="{{ $zone->name }}" />
						</div>
			
						<div class="form-group col-md-6">
							<label for="zone">Zona</label>
							<select name="zone" class="form-control">
								<option value="Pacifico" {{ $zone->zone == "Pacifico" ? 'selected' : '' }}>Pacifico</option>
								<option value="Norte" {{ $zone->zone == "Norte" ? 'selected' : '' }}>Norte</option>
								<option value="Centro" {{ $zone->zone == "Centro" ? 'selected' : '' }}>Centro</option>
							</select>
						</div>
						
						<div class="form-group col-md-6">
							<label for="manager_email"> @lang('equicare.manager_email') </label>
							<input type="email" name="manager_email" class="form-control"
							value="{{ $zone->manager_email }}" />
						</div>
						<br/>
						<div class="form-group col-md-12">
							<input type="submit" value="@lang('equicare.submit')" class="btn btn-primary btn-flat"/>
						</div>
						</div>
					</form>
        </div>
    </div>
@endsection
