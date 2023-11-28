<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActividadesPropuestasFormRequest extends FormRequest
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
            'detalle_plan_mejora_id' => 'required',
            'responsable_id' => 'required',
            'descri_actividades' =>'required|max:256',
            'medio_verificacion'=>'required|max:256',
            'plazo'=>'required|max:80',
            'fuente_financiamiento'=>'required|max:80',
            'inversion_prevista'=>'required|max:256',
           // 'estado'=>'required|max:25',


        ];
    }
}
