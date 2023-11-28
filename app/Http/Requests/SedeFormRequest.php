<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SedeFormRequest extends FormRequest
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
            'descri_sede'=>'required|unique:sedes|max:255',
        ];
    }
}
