<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBioRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description'=>'sometimes|min:100',
            'policies'=>'sometimes|min:20',
            'subjects'=>'sometimes',
            'cv'=>'sometimes|max:5000|mimes:pdf,docx,txt,jpeg,svg,png,gif,docm,odt,svg,png,jpg,gif',
            'smaples'=>'sometimes',
            'samples.*'=>'mimes:pdf,docx,txt,jpeg,svg,png,gif,docm,odt,xlsx,xlsm,xlsb,xltx,svg, png,jpg,gif',
        ];
    }
}
