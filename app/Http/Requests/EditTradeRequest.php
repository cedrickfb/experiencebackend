<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTradeRequest extends FormRequest
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
            'description' => 'max:16777215',
            'amount'  => 'required|max:99999|min:0|numeric',
        ];
    }
}
