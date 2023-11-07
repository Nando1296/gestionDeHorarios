<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMateria extends FormRequest
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
        'nombre' => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ]+$/u|min:5|max:60',
        'codigo' => 'bail|required|numeric|digits_between:6,10|unique:materias,Cod_materia',
        
        ];
    }

    

    public function messages()
    {
        return[
            'nombre.regex' => 'Solo se aceptan caracteres alfabéticos y espacios.',
            'nombre.unique'=> 'Ya existe una materia registrada con ese nombre.',
            'nombre.required'=>'El campo nombre es obligatorio',
            'codigo.required'=>'El campo código es obligatorio',
            'codigo.unique'=> 'Ya existe una materia registrada con ese código.',
            
        ];
    }
}
