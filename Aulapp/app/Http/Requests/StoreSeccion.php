<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreSeccion extends FormRequest
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
            'nombre' => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ 0-9]+$/u|min:10|max:50|unique:sections',
            'descripcion' => 'bail|required|min:10|max:50'
        ];
    }
   
    public function messages()
    {
        return[
            'nombre.required'=>'El campo \'Nombre\' es obligatorio',
            'nombre.regex' => 'Solo se aceptan caracteres alfanuméricos y espacios.',
            'nombre.unique'=> 'Ya existe una seccion de aula registrado con ese nombre.',
            'descripcion.required'=>'El campo \'Descripción\' es obligatorio',

        ];
    }
}
