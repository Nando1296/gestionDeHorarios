<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Usuario;
class StoreLogin extends FormRequest
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
            'usuario' => ['required','exists:usuarios,usuario'],
            'contrasenia' => ['required'],
        ];
    }
    public function messages()
    {
        return[
            'usuario.exists'=>'El usuario ingresado no existe en nuestros registros.',
            'usuario.required'=>'El campo usuario es obligatorio.',
            'contrasenia.required'=>'El campo contraseña es obligatorio.',
           
            
        ];
    }
}
