@extends('layouts.admin')
@section('body-title')
    @lang('equicare.accesorios')
@endsection
@section('title')
	| @lang('equicare.accesorios')
@endsection
@section('breadcrumb')
<li class="active"> @lang('equicare.accesorios')</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title">@lang('Crear Accesorio') </h4>
				</div>

				<div class="box-body ">
					@include ('errors.list')
					<form class="form" method="post" action="{{ route('accesories.store') }}">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<div class="row">
							<div class="form-group col-md-6">
								<label for="nombre"> Nombre</label>
								<input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" />
							</div>
							<div class="form-group col-md-6">
								<label for="lote_id"> @lang('equicare.lote') </label>
								<select name="lote_id" class="form-control">
									<option value="">Seleccione un lote</option>
									@if(isset($lotes))
										@foreach ($lotes as $lote)
											<option value="{{ $lote->id }}"
												{{ old('lote_id')?'selected':'' }}
												>Lote No.{{ $lote->nlote }}</option>
											</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="proveedor_id"> @lang('equicare.proveedor_id') </label>
								<select name="proveedor_id" class="form-control">
									<option value="">Seleccione un proveedor</option>
									@if(isset($proveedores))
										@foreach ($proveedores as $proveedor)
											<option value="{{ $proveedor->id }}"
												{{ old('proveedor_id')?'selected':'' }}
												>{{ $proveedor->nombre }}</option>
										@endforeach
									@endif
								
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="catalogo"> Catalogo</label>
							<input type="text" name="catalogo" class="form-control" value="{{ old('catalogo') }}" />
							</div>
							<div class="form-group col-md-6">
								<label for="observaciones">Observaciones </label>
								<input type="text" name="observaciones" class="form-control" value="{{ old('observaciones') }}" />
							</div>
					
							<div class="form-group col-md-6">
								<label for="inventario"> Inventario</label>
								<input type="number" name="inventario" class="form-control" value="{{ old('inventario') }}" />
							</div>
							<div class="form-group col-md-6">
								<label for="costo"> Costo</label>
								<input type="number" name="costo" class="form-control" value="{{ old('costo') }}" />
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