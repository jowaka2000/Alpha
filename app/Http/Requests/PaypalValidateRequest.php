<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaypalValidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->user()->blocked;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'=>'required',
            'amount'=>'required|numeric|gt:0.9999',
        ];
    }
}
