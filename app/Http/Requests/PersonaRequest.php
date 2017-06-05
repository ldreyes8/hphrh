<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class PersonaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //protected $redirect;

    public function rules()
    {
        return [
        'identificacion'=>'required|max:13',
            'nombre1'=>'required|max:40',
            'apellido1'=>'required|max:40',
            'celular'=>'required',
            'nit'=>'required',
            'pretension'=>'required',
            //'g-recaptcha-response' => 'required|recaptcha',
            //
        ];
    }
    public function messages(){
        return [
        'identificacion.required'=>'Su identificacion es requerida',
        'nombre1.required' => 'Primer nombre es requerido',
        'apellido1.required' => 'Primer apellido es requerido',
        'celular.required'=>'Campo celular es requerido',
        'nit.required'=>'Campo nit es requerido',
        'pretension.required'=>'Campo pretension es requerido',
        //'g-recaptcha-response.required'=>'Validación oligatoria',
         ];
    }
    /*public function response(array $errors)
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
    }*/
}
