<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSettingsRequest extends FormRequest
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
            'company_name' => 'required|max:100',
            'no_tps' => 'required|max:50',
            'no_tvq' => 'required|max:50',
            'address' => 'required|max:100',
            'city' => 'required|max:50',
            'province' => 'required|max:50',
            'country' => 'required|max:50',
            'postal_code' => 'required|max:6|zipCode',
            'telephone' => 'required|numeric',
            'fax' => 'required|max:50',
            'email' => 'required|max:80|email',
        ];
    }
}
