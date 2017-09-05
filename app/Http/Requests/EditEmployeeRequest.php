<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditEmployeeRequest extends FormRequest
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
        $prod = $this->request;
       //dd($prod);
        return [
            'firstname' => 'required|max:50|anyname',
            'lastname' => 'required|max:50|anyname',
            'password' => 'required|max:25',
        ];
    }
}
