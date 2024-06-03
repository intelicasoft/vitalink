@extends('layouts.admin')
@section('body-title')
    @lang('equicare.provider')
@endsection
@section('title')
	| @lang('equicare.provider')
@endsection
@section('breadcrumb')
<li class="active">Proveedores</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"> Agregar Proveedores </h4>
				</div>

				<div class="box-body ">
					@include ('errors.list')
					<form class="form" method="post" action="{{ route('providers.store') }}">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<div class="row">
							<div class="form-group col-md-6">
								<label for="nombre"> @lang('equicare.name') </label>
								<input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" />
							</div>
							<div class="form-group col-md-6">
								<label for="observaciones"> Observaciones </label>
								<input type="text" name="observaciones" class="form-control" value="{{ old('observaciones') }}" />
							</div>
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