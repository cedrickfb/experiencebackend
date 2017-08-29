<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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

        if($prod->get('id') == null){
            return [
                'codebar' => 'required|max:191|unique:products',
                'name' => 'required|max:191',
                'original_cost' => 'required|numeric|min:0|max:999999999999999999',
                'selling_price' => 'required|numeric|min:0|max:999999999999999999',
                'min_qty' => 'required|numeric|min:0|max:9999999999',
                'max_qty' => 'required|numeric|min:0|max:9999999999',
                'deposit' => 'required|numeric|min:0|max:999999',
                'qty' => 'required|numeric|min:0|max:999999',
            ];
        }else{
            return [
                'codebar' => 'required|max:191|uniqueExcludeMe:products,'.$prod->get('id'),
                'name' => 'required|max:191',
                'original_cost' => 'required|numeric|min:0|max:999999999999999999',
                'selling_price' => 'required|numeric|min:0|max:999999999999999999',
                'min_qty' => 'required|numeric|min:0|max:9999999999',
                'max_qty' => 'required|numeric|min:0|max:9999999999',
                'deposit' => 'required|numeric|min:0|max:999999',
                'qty' => 'required|numeric|min:0|max:999999',
            ];
        }

    }
}
