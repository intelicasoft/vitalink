@extends('layouts.admin')
@section('body-title')
    Ordenes de Servicio
@endsection
@section('title')
	| Ordenes de servicio
@endsection
@section('breadcrumb')
<li class="active">Ordenes de Servicio</li>
@endsection

@section('content')

    <style>
        .box-body {
            padding: 1rem;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
        }
        .signature-pad {
            cursor:;
            border: 1px solid #c7c7c7 var(--gray);
            width: 100%;
            height: 200px;
            border-radius: 4px;
        }
    </style>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

                <div class="box-header with-border">
                    <h4 class="box-title">
                        Finalizar Orden de Servicio
                    </h4>
                </div>
                <div class="box-body">
					@include ('errors.list')
                    <form class="signature-pad-form" method="post" action="{{ route('orders.update',$ticket->id) }}"  enctype="multipart/form-data">
						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						<div class="row">

                            <div class="form-group col-md-6">
                                <label for="FirmaUser">Firma del Usuario</label>
                                <canvas id="FirmaUser" class="signature-pad" width="400" height="200"></canvas>
                                <input type="hidden" name="user_sign" id="user_sign">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="FirmaSpecialist">Firma del Ingeniero o Especialista</label>
                                <canvas id="FirmaSpecialist" class="signature-pad" width="400" height="200"></canvas>
                                <input type="hidden" name="specialist_sign" id="specialist_sign">
                            </div>


                            <div class="form-group col-md-12">
                                <input type="submit" value="@lang('equicare.submit')" class="btn btn-primary btn-flat"/>
                            </div>
						</div>
					</form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.querySelector('.signature-pad-form');
            const userCanvas = document.getElementById('FirmaUser');
            const specialistCanvas = document.getElementById('FirmaSpecialist');
            const userCtx = userCanvas.getContext('2d');
            const specialistCtx = specialistCanvas.getContext('2d');
            let writingModeUser = false;
            let writingModeSpecialist = false;
    
            const setUpCanvas = (canvas, ctx, writingMode) => {
                canvas.addEventListener('pointermove', (e) => {
                    if (writingMode) {
                        const { x, y } = getTargetPosition(e, canvas);
                        ctx.lineTo(x, y);
                        ctx.stroke();
                    }
                });
    
                canvas.addEventListener('pointerup', () => {
                    writingMode = false;
                });
    
                canvas.addEventListener('pointerdown', (e) => {
                    writingMode = true;
                    ctx.beginPath();
                    const { x, y } = getTargetPosition(e, canvas);
                    ctx.moveTo(x, y);
                });
    
                ctx.lineWidth = 3;
                ctx.lineJoin = ctx.lineCap = 'round';
            };
    
            const getTargetPosition = (e, canvas) => {
                const rect = canvas.getBoundingClientRect();
                return {
                    x: e.clientX - rect.left,
                    y: e.clientY - rect.top
                };
            };
    
            setUpCanvas(userCanvas, userCtx, writingModeUser);
            setUpCanvas(specialistCanvas, specialistCtx, writingModeSpecialist);
    
            form.addEventListener('submit', function (e) {
                e.preventDefault();
    
                const userSignDataURL = userCanvas.toDataURL();
                const specialistSignDataURL = specialistCanvas.toDataURL();
    
                document.getElementById('user_sign').value = userSignDataURL;
                document.getElementById('specialist_sign').value = specialistSignDataURL;
    
                form.submit();
            });
        });
    </script>

@endsection
