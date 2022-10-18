<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
                'assignment_type'=>'required',
                'subject'=>'required',
                'service'=>'required',
                'pages'=>'required',
                'words'=>'required',
                'spacing'=>'required',
                'sources'=>'required',
                'citation'=>'required',
                'deadline'=>'required',
                'pay_day'=>'required',
                'language'=>'required',
                'topic'=>'required',
                'order_visibility'=>'required',
                'description'=>'sometimes',
                'docs'=>'sometimes',
                'docs.*'=>'required|bail|max:5000|mimes:pdf,docx,txt,jpeg,svg,png,gif,docm,odt,xlsx,xlsm,xlsb,xltx,svg, png,jpg,gif',
                'price'=>'required',
        ];
    }
}
