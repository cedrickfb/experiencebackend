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
            'firstname' => 'required|max:50|anyname',
            'lastname' => 'required|max:50|anyname',
            'tel_prefix' => 'required|min:100|max:999|numeric',
            'telephone' => 'required|min:7|max:7',
            /*'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',*/
            'postal_code' => 'required|min:6|max:6|zipCode',
            'comments' => 'max:500',
            'password' => 'required|max:25',
            'credits' => 'required',
        ];
    }
}
