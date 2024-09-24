@extends('layouts.admin')
@section('body-title')
Lotes
@endsection
@section('title')
	| Lotes
@endsection
@section('breadcrumb')
<li class="active"> Lotes</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title">@lang('Crear Lotes') </h4>
				</div>

				<div class="box-body ">
					@include ('errors.list')
					<form class="form" method="post" action="{{ route('lots.store') }}">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<div class="row">
							<div class="form-group col-md-6">
								<label for="nlote"> Numero de lote</label>
								<input type="text" name="nlote" class="form-control" value="{{ old('nlote') }}" />
							</div>
							<div class="form-group col-md-6">
								<label for="nivel">Nivel</label>
								<select name="nivel" class="form-control">
									<option value="">Selecciona un nivel</option>
									<option value="NIVEL 1" {{ old('nivel') == "NIVEL 1" ? 'selected' : '' }}>NIVEL 1</option>
									<option value="NIVEL 2" {{ old('nivel') == "NIVEL 2" ? 'selected' : '' }}>NIVEL 2</option>
									<option value="NIVEL 3" {{ old('nivel') == "NIVEL 3" ? 'selected' : '' }}>NIVEL 3</option>
								</select>
							</div>

							<div class="form-group col-md-6">
								<label for="marca_id"> Marca </label>
								<select name="marca_id" class="form-control">
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
								<label for="fabricacion"> Fecha de fabricación</label>
								<input type="date" name="fabricacion" class="form-control" value="{{ old('fabricacion') }}" />
							</div>
							<div class="form-group col-md-6">
								<label for="expiracion"> Fecha de expiración</label>
								<input type="date" name="expiracion" class="form-control" value="{{ old('expiracion') }}" />
							</div>
							<div class="form-group col-md-6">
								<label for="observaciones">Observaciones </label>
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