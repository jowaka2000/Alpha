<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRefundRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->user_type==='employer';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'instruction'=>'required',
            'files'=>'sometimes',
            'files.*'=>'required|mimes:pdf,docx,txt,jpeg,svg,png,gif,docm,odt,xlsx,xlsm,xlsb,xltx',
        ];
    }
}
