<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActividadesRealizadasFormRequest extends FormRequest
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
            'actividades_propuesta_id'=> 'required',
            'responsable_id' => 'required',
             'descri_realizadas' =>'required|max:256',
            //  'medio_verificacion'=>'required|max:256',
             'plazo'=>'required|max:256',
            'cumplimiento'=>'required|max:80',
            'resultados'=>'required|max:256',
            'avance'=>'required|max:80',
            'pendientes'=>'required|max:256',
            //'estado'=>'required|max:25',

            // 'medio_verificacion_id' => 'required',
           //  'actividades_realizadas_id' => 'required'

        ];
    }
}
