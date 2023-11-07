<?php

namespace App\Http\Requests;

use App\Rules\RuleSeleccionCarrera;
use App\Rules\RuleSeleccionMateri;
use App\Rules\SeleccionMateri;
use Illuminate\Foundation\Http\FormRequest;

class StoreMateriaCarrera extends FormRequest
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
            'carrera'=>[new RuleSeleccionCarrera],
            'materia'=>[new RuleSeleccionMateri]
        ];
    }
}
