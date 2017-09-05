<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCustomerRequest extends FormRequest
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
            'firstname' => 'max:50|anyname',
            'lastname' => 'max:50|anyname',
            'tel_prefix' => 'min:100|max:999|numeric',
            'telephone' => 'min:7|max:7',
            /*'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',*/
            'postal_code' => 'max:6',
            'comments' => 'max:500',
            'password' => 'max:25',
        ];
    }
}
