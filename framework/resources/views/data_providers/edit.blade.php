@extends('layouts.admin')
@section('body-title')
Proveedores
@endsection
@section('title')
	| Proveedores
@endsection
@section('breadcrumb')
<li class="active">Proveedores</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

                <div class="box-header with-border">
                    <h4 class="box-title">
                        @lang('equicare.edit_dataprovider')
                    </h4>
                </div>
                <div class="box-body">
					@include ('errors.list')
                    <form class="form" method="post" action="{{ route('providers.update',$provider->id) }}">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="PATCH"/>
						<div class="row">
						<div class="form-group col-md-6">
							<label for="nombre"> @lang('equicare.name') </label>
							<input type="text" name="nombre" class="form-control"
							value="{{ $provider->nombre }}" />
						</div>
						
						<div class="form-group col-md-6">
							<label for="observaciones"> Observaciones </label>
							<input type="text" name="observaciones" class="form-control"
							value="{{ $provider->observaciones }}" />
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
