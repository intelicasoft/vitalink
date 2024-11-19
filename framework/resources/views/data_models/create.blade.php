@extends('layouts.admin')
@section('body-title')
    @lang('equicare.model')
@endsection
@section('title')
	| @lang('equicare.model')
@endsection
@section('breadcrumb')
<li class="active">Modelos</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"> Crear Modelo </h4>
				</div>

				<div class="box-body ">
					@include ('errors.list')
					<form class="form" method="post" action="{{ route('models.store') }}">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<div class="row">
							<div class="form-group col-md-6">
								<label for="name"> @lang('equicare.name') </label>
								<input type="text" name="name" class="form-control" value="{{ old('name') }}" />
							</div>
							
							<div class="form-group col-md-6">
								<label for="short_name"> Nombre corto </label>
								<input type="text" name="short_name" class="form-control" value="{{ old('short_name') }}" />
							</div>

							<div class="form-group col-md-6">
								<label for="links"> Links de video </label>
								<input type="url" name="links" class="form-control" value="{{ old('links') }}" />
							</div>
							
							<div class="form-group col-md-6">
								<label for="brand_id"> Marca </label>
								<select name="brand_id" class="form-control">
									<option value="">Seleccione una marca</option>
									@if(isset($marcas))
										@foreach ($marcas as $marca)
											<option value="{{ $marca->id }}"
												{{ old('marca_id')?'selected':'' }}
												>{{ $marca->name }}</option>
											</option>
										@endforeach
									@endif
								</select>
							</div>

							<div class="form-group col-md-6">

								<label for="description"> @lang('equicare.description') </label>
								<input type="text" name="description" class="form-control" value="{{ old('description') }}" />
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