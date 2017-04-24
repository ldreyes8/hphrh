<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $redirect = "empleado/permiso";
    
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fini'=>'required',
            'ffin'=>'required',
        ];
    }

    public function messages(){
        return [
        'fini.required' => 'El campo fecha inicio es requerido',
        'ffin.required'=>'El campo fecha final es requerido'
        //'fechainicio.min' => 'El minimo permitido son 3 caracteres'
        //'fechainicio.max' => 'El maximo permitido son 12 caracteres'
         ];
    }

    public function response(array $errors)
    {
        if($this->ajax())
        {
            return response()->json($errors,200);
        }
        else
        {
            return redirect($this->redirect)
            ->withErrors($errors, 'formulario')
            ->withInput();
        }
    }
}
