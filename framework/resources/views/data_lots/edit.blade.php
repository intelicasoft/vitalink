@extends('layouts.admin')
@section('body-title')
	Lotes
@endsection
@section('title')
	| Lotes
@endsection
@section('breadcrumb')
<li class="active">Lotes</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

                <div class="box-header with-border">
                    <h4 class="box-title">
                        @lang('equicare.edit_datalots')
                    </h4>
                </div>
                <div class="box-body">
					@include ('errors.list')
                    <form class="form" method="post" action="{{ route('lots.update',$lot->id) }}">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="PATCH"/>
						<div class="row">
						<div class="form-group col-md-6">
							<label for="nlote"> Numero de Lote </label>
							<input type="text" name="nlote" class="form-control"
							value="{{ $lot->nlote }}" />
						</div>
						
						<div class="form-group col-md-6">
							<label for="nivel">Nivel</label>
							<select name="nivel" class="form-control">
								<option value="NIVEL 1" {{ $lot->nivel == "NIVEL 1" ? 'selected' : '' }}>NIVEL 1</option>
								<option value="NIVEL 2" {{ $lot->nivel == "NIVEL 2" ? 'selected' : '' }}>NIVEL 2</option>
								<option value="NIVEL 3" {{ $lot->nivel == "NIVEL 3" ? 'selected' : '' }}>NIVEL 3</option>
							</select>
						</div>
						<br/>
					
						<div class="form-group col-md-6">
							<label for="marca_id"> Marca</label>
							<select name="marca_id" class="form-control">
								<option value="" {{ old('marca_id') ? 'Selecciona un marca' : 'selected' }}></option>
								@if(isset($marcas))
									@foreach ($marcas as $marca)
										<option value="{{ $marca->id }}"
											{{ $lot->marca_id == $marca->id ? 'selected' : '' }}
											>{{ $marca->name }}</option>
									@endforeach
								@endif
							
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="fabricacion"> Fecha de Fabricación </label>
							<input type="date" name="fabricacion" class="form-control"
							value="{{ $lot->fabricacion }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="expiracion"> Fecha de Expiración </label>
							<input type="date" name="expiracion" class="form-control"
							value="{{ $lot->expiracion }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="observaciones"> Observaciones </label>
							<input type="text" name="observaciones" class="form-control"
							value="{{ $lot->observaciones }}" />
						</div>
						<div class="form-group col-md-12">
							<input type="submit" value="@lang('equicare.submit')" class="btn btn-primary btn-flat"/>
						</div>
						</div>
					</form>
        </div>
    </div>
@endsection
