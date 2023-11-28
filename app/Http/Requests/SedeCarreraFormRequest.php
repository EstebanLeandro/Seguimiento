<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SedeCarreraFormRequest extends FormRequest
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
        'carrera_id' => 'required|carrera,id',
        'sede_id' => 'required|sede,id',
     //   'skills' => 'in:Salto del Guirá,curuguaty,Katueté'
    ];
    }
    
}
