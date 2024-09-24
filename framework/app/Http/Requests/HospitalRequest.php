<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Hospital;

class HospitalRequest extends FormRequest {
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
	public function rules(Request $request) {
		
		
			$rules=[
			'name' => 'required|unique:hospitals,name,'.$request->id,
			'email' => 'nullable',  //antes era required
			'contact_person' => 'required',
			'phone_no' => 'required|numeric|min:6',
			'latitude' => 'required',
			'longitude' => 'required',
			'mobile_no' => 'required|numeric|min:10',
			'address' => 'required',
	     	'slug'=>'required|max:8|unique:hospitals,slug,'.$request->id,
			];
			return $rules;
		}
	public function messages() {
		return [
			'mobile_no.required' => 'El campo del número móvil es obligatorio.',
			'phone_no.required' => 'El campo del número telefónico es obligatorio.',
			'slug.required' => 'El campo del nombre corto es obligatorio',
			'slug.max' => 'El nombre corto debe contener máximo 8 caracteres',
			'slug.unique' => 'El nombre corto debe ser único',
		];
	}
}
