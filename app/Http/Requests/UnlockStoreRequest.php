<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnlockStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //check if the user has subscribed
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
            'unlock_type' => 'required',
            'unlock_link' => 'sometimes',
            'question' => 'required',
            'instructions' => 'sometimes',
            'files' => 'sometimes',
            'files.*' => 'required|bail|max:5000|mimes:pdf,docx,txt,jpeg,svg,png,gif,docm,odt,xlsx,xlsm,xlsb,xltx,svg, png,jpg,gif',
        ];
    }
}
