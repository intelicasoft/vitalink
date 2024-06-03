@extends('layouts.admin')
@section('body-title')
    @lang('equicare.marcas')
@endsection
@section('title')
	| @lang('equicare.marcas')
@endsection
@section('breadcrumb')
<li class="active">Marcas</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

                <div class="box-header with-border">
                    <h4 class="box-title">
                        @lang('equicare.edit_databrand')
                    </h4>
                </div>
                <div class="box-body">
					@include ('errors.list')
                    <form class="form" method="post" action="{{ route('brands.update',$brand->id) }}">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="PATCH"/>
						<div class="row">
						<div class="form-group col-md-6">
							<label for="name"> @lang('equicare.name') </label>
							<input type="text" name="name" class="form-control"
							value="{{ $brand->name }}" />
						</div>
						<div class="form-group col-md-6">
							<label for="type"> Tipo de Marca  </label>
							<select name="type" class="form-control">
								<option value="INSTRUMENTOS" {{ $brand->type == "INSTRUMENTOS" ? 'selected' : '' }}>INSTRUMENTOS</option>
								<option value="CONTROLES" {{ $brand->type == "CONTROLES" ? 'selected' : '' }}>CONTROLES</option>
								<option value="REACTIVOS" {{ $brand->type == "REACTIVOS" ? 'selected' : '' }}>REACTIVOS</option>
								<option value="LOTES" {{ $brand->type == "LOTES" ? 'selected' : '' }}>LOTES</option>

							</select>
							
						</div>
						
						<div class="form-group col-md-6">
							<label for="description"> @lang('equicare.description') </label>
							<input type="text" name="description" class="form-control"
							value="{{ $brand->description }}" />
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
