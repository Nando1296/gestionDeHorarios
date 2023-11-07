<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use App\Models\Grupo;
use App\Models\Materia_Carrera;
use Illuminate\Contracts\Validation\Rule;

class RuleUniqueGrupo implements Rule,DataAwareRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
   

    public function __construct()
    {
        //
    }

    protected $data;
    public function setData($data)
    {
        $this->data=$data;
        return $this;
    }
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $bool=true;
        if($this->data['carrera']!="Seleccione una carrera"){
            $nombre='G:'. $this->data['nombre'];
            $materia_carrera=Materia_Carrera::where('materia_id',$value)->where('carrera_id',$this->data['carrera'])->get();
            $grupo=Grupo::where('nombre',$nombre)->where('materia_carrera_id',$materia_carrera[0]->id)->where('estado',true)->get();
            $bool=$grupo->count()==0;
        }
        
        return $bool;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya existe el grupo G:'.$this->data['nombre'].' en esta materia';
    }
}
