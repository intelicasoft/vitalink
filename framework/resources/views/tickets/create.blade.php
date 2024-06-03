@extends('layouts.admin')
@section('body-title')
    @lang('Tickets')
@endsection
@section('title')
	| @lang('Tickets')
@endsection
@section('breadcrumb')
<li class="active">Tickets</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"> Tickets </h4>
				</div>

				<div class="box-body ">
					@include ('errors.list')
					<form class="form" method="post" action="{{ route('tickets.store') }} " enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<div class="row">
							<div class="form-group col-md-6">
								<label for="title"> Titulo </label>
								<input type="text" name="title" class="form-control" value="{{ old('title') }}" />
							</div>

							<div class="form-group col-md-6">
								<label for="manager_id"> @lang('equicare.lote') </label>
								<select name="manager_id" class="form-control">
									<option value="">Encargado</option>
									@if(isset($encargados))
										@foreach ($encargados as $encargado)
											<option value="{{ $encargado->id }}"
												{{ old('manager_id')?'selected':'' }}
												>{{ $encargado->name }}</option>
											</option>
										@endforeach
									@endif
								</select>
							</div>

							<div class="form-group col-md-6">
								<label for="equipment_id"> Equipo Clinico </label>
								<select name="equipment_id" class="form-control">
									<option value="">Equipo clinico</option>
									@if(isset($equipos))
										@foreach ($equipos as $equipo)
											<option value="{{ $equipo->id }}"
												{{ old('equipment_id')?'selected':'' }}
												>{{ $equipo->name }}</option>
											</option>
										@endforeach
									@endif
								</select>
							</div>

							<div class="form-group col-md-6">
								<label for="priority"> Prioridad  </label>
								<select name="priority" class="form-control">
									<option value="">Prioridad</option>
									<option value="1" {{ old('priority') == "1" ? 'selected' : '' }}>BAJA</option>
									<option value="2" {{ old('priority') == "2" ? 'selected' : '' }}>MEDIA</option>
									<option value="3" {{ old('priority') == "3" ? 'selected' : '' }}>ALTA</option>
								</select>
							</div>
						
							<div class="form-group col-md-6">
								<label for="category"> Categoria  </label>
								<select name="category" class="form-control">
									<option value="">Categoria</option>
									<option value="MANTENIMIENTO PREVENTIVO (M)" {{ old('category') == "MANTENIMIENTO PREVENTIVO (M)" ? 'selected' : '' }}>MANTENIMIENTO PREVENTIVO (M)</option>
									<option value="INSTALACIÓN (M)" {{ old('category') == "INSTALACIÓN (M)" ? 'selected' : '' }}>INSTALACIÓN (M)</option>
									<option value="DESINSTALACIÓN (M)" {{ old('category') == "DESINSTALACIÓN (M)" ? 'selected' : '' }}>DESINSTALACIÓN (M)</option>
									<option value="REACONDICIONAMIENTO (M)" {{ old('category') == "REACONDICIONAMIENTO (M)" ? 'selected' : '' }}>REACONDICIONAMIENTO (M)</option>
									<option value="CAPACITACIÓN (M)" {{ old('category') == "CAPACITACIÓN (M)" ? 'selected' : '' }}>CAPACITACIÓN (M)</option>
									<option value="VERIFICACIÓN (M)" {{ old('category') == "VERIFICACIÓN (M)" ? 'selected' : '' }}>VERIFICACIÓN (M)</option>
									<option value="INCIDENCIA CORRECTIVA (I)" {{ old('category') == "INCIDENCIA CORRECTIVA (I)" ? 'selected' : '' }}>INCIDENCIA CORRECTIVA (I)</option>
									<option value="ASESORIA (I)" {{ old('category') == "ASESORIA (I)" ? 'selected' : '' }}>ASESORIA (I)</option>
									<option value="ABASTECIMIENTO (I)" {{ old('category') == "ABASTECIMIENTO (I)" ? 'selected' : '' }}>ABASTECIMIENTO (I)</option>
									<option value="SISTEMAS TI (I)" {{ old('category') == "SISTEMAS TI (I)" ? 'selected' : '' }}>SISTEMAS TI (I)</option>
								</select>
							</div>

							<div class="form-group col-md-6">
								<label for="contact"> Contacto </label>
								<input type="email" name="contact" class="form-control" value="{{ old('contact') }}" />
							</div>

							<div class="form-group col-md-6">
								<label for="phone"> Telefono </label>
								<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" />
							</div>

							<div class="form-group col-md-6">
								<label for="extension"> Extension </label>
								<input type="text" name="extension" class="form-control" value="{{ old('extension') }}" />
							</div>

							<div class="form-group col-md-6">
								<label for="adress"> Direccion </label>
								<input type="text" name="adress" class="form-control" value="{{ old('adress') }}" />
							</div>

							<div class="form-group col-md-6">
								<label for="failure"> Actividad </label>
								<input type="text" name="failure" class="form-control" value="{{ old('failure') }}" />
							</div>

							<div class="form-group col-md-6">
								<label for="description"> @lang('equicare.description') </label>
								<input type="text" name="description" class="form-control" value="{{ old('description') }}" />
							</div>

							<div class="form-group col-md-6">
								<label for="images"> Imagen </label>
								<input type="file" name="images" class="form-control" value="{{ old('images') }}" />
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