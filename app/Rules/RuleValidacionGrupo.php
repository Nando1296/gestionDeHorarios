<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;
use App\Models\Grupo;
use App\Models\Materia_Carrera;

class RuleValidacionGrupo implements Rule,DataAwareRule
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

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    protected $data;

    public function setData($data)
    {
        $this->data=$data;
        return $this;
    }

    public function passes($attribute, $value)
    {
        $respuesta=true;

        if($value=="Seleccione una carrera" && $this->data['nombre']!="" && $this->data['materia']!="Seleccione una materia"){    
            $respuesta=false;
            $ids_materias_carreras=Materia_Carrera::where('materia_id',$this->data['materia'])->get();
          
            if(sizeof($ids_materias_carreras)>0){
                for($i=0;$i<sizeof($ids_materias_carreras);$i=$i+1){
                   if(!Grupo::where('materia_carrera_id',$ids_materias_carreras[$i]->id)->where('nombre','G:'.$this->data['nombre'])->where('estado',true)->exists()){
                    $respuesta=true;
                    
                   }
                }
            }
        }
       
       
        return $respuesta;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya existe el registro del grupo en todas las carreras que contienen la materia';
}
}