<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCostRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		$rules = [];


if($this->request->cost=[]){

	foreach ($this->request->get('cost') as $key => $val) {
		$rules['equipments.' . $key] = 'required';
		$rules['start_dates.' . $key] = 'required';
		$rules['end_dates.' . $key] = 'required';
		$rules['cost.' . $key] = 'required|numeric';
	}
}
else{
	$rules['equipments'] ='required';
	$rules['start_dates'] ='required';
	$rules['end_dates'] ='required';
	$rules['cost'] ='required|numeric';
}
	
	// }
		$rules = [
			'tp_name' => 'required_if:cost_by,=,tp',
			'tp_mobile' => 'required_if:cost_by,=,tp|nullable|numeric',
			'tp_email' => 'required_if:cost_by,=,tp|nullable|email',
			'hospital_id' => 'required',
			'type' => 'required',
			'cost_by' => 'required',
		];
		return $rules;
	}

	public function messages() {
		$messages = [];
				if ($this->cost) {
					foreach ($this->cost as $i => $v) {
						$messages['equipments.' . $i . '.required'] = 'El campo Equipo es obligatorio';
						$messages['start_dates.' . $i . '.required'] = 'El campo Fecha de Inicio es obligatorio';
						$messages['end_dates.' . $i . '.required'] = 'El campo Fecha de Fin es obligatorio';
						$messages['cost.' . $i . '.required'] = 'El campo Costo es obligatorio';
						$messages['cost.' . $i . '.numeric'] = 'El Costo debe ser un número.';
					}
				}
				$messages['tp_name.required_if'] = 'El campo Nombre es obligatorio';
				$messages['tp_mobile.required_if'] = 'El campo Número de Móvil es obligatorio';
				$messages['tp_mobile.numeric'] = 'El campo Número de Móvil debe ser un número';
				$messages['tp_email.required_if'] = 'El campo Email es obligatorio';
				$messages['tp_email.email'] = 'El Email debe contener una dirección de correo válida';
				$messages['hospital_id.required'] = 'El campo Hospital es obligatorio';
				$messages['cost_by.required'] = 'El campo Cost By es obligatorio';
				$messages['type.required'] = 'El campo Tipo es obligatorio';
				return $messages;
	}
}
