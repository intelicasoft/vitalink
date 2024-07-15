@extends('layouts.admin')
@section('body-title')
    @lang('equicare.accesorios')
@endsection
@section('title')
	| @lang('equicare.accesorios')
@endsection
@section('breadcrumb')
<li class="active">@lang('equicare.accesorios')</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

                <div class="box-header with-border">
                    <h4 class="box-title">
                        @lang('equicare.edit_dataaccesory')
                    </h4>
                </div>
                <div class="box-body">
					@include ('errors.list')
                    <form class="form" method="post" action="{{ route('accesories.update',$accesory->id) }}">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="PATCH"/>
						<div class="row">
						<div class="form-group col-md-6">
							<label for="nombre"> @lang('equicare.name') </label>
							<input type="text" name="nombre" class="form-control"
							value="{{ $accesory->nombre }}" />
						</div>
						
						<div class="form-group col-md-6">
							<label for="lote_id"> lotes  </label>
							<select name="lote_id" class="form-control">
								<option value="" {{ old('lote_id') ? 'Selecciona un lote' : 'selected' }}></option>
								@if(isset($lotes))
									@foreach ($lotes as $lote)
										<option value="{{ $lote->id }}"
											{{ $accesory->lote_id == $lote->id ? 'selected' : '' }}
											>Lote No.{{ $lote->nlote }}</option>
									@endforeach
								@endif
							
							</select>
						</div>
						<br/>
						
						<div class="form-group col-md-6">
							<label for="proveedor_id"> @lang('equicare.proveedor_id') </label>
							<select name="proveedor_id" class="form-control">
								<option value="" {{ old('proveedor_id') ? 'Selecciona un proveedor_id' : 'selected' }}></option>
								@if(isset($proveedores))
									@foreach ($proveedores as $proveedor)
										<option value="{{ $proveedor->id }}"
											{{ $accesory->proveedor_id == $proveedor->id ? 'selected' : '' }}
											>{{ $proveedor->nombre }}</option>
									@endforeach
								@endif
							
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="catalogo"> @lang('equicare.catalog') </label>
							<input type="text" name="catalogo" class="form-control"
							value="{{ $accesory->catalogo }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="inventario"> @lang('equicare.inventory') </label>
							<input type="text" name="inventario" class="form-control"
							value="{{ $accesory->inventario }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="costo"> @lang('equicare.cost') </label>
							<input type="text" name="costo" class="form-control"
							value="{{ $accesory->costo }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="observaciones"> @lang('equicare.observations') </label>
							<input type="text" name="observaciones" class="form-control"
							value="{{ $accesory->observaciones }}" />
						</div>
						



						<div class="form-group col-md-12">
							<input type="submit" value="@lang('equicare.submit')" class="btn btn-primary btn-flat"/>
						</div>


						</div>
					</form>
        </div>
    </div>
@endsection
