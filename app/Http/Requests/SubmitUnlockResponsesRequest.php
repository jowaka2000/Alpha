<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitUnlockResponsesRequest extends FormRequest
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
            'completed_message' => 'sometimes',
            'completed_link' => 'sometimes',
            'answers' => 'required',
            'files' => 'sometimes',
            'files.*' => 'required|max:5000|mimes:pdf,docx,txt,jpeg,svg,png,gif,docm,odt,xlsx,xlsm,xlsb,xltx,svg, png,jpg,gif',
        ];
    }
}
