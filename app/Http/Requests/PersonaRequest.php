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
    public function rules()
    {
        return [
        'identificacion'=>'required|max:13',
            'nombre1'=>'required|max:40',
            'apellido1'=>'required|max:40',
            'celular'=>'required',
            'nit'=>'required',
            'pretension'=>'required',
            
            //
        ];
    }
}
