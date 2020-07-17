<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewSuperMarketRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'string|required',
            'phone_number' => 'required|max:12|min:10',
            'location' => 'string',
            'district_id' => 'required|exists:districts,id'
        ];
    }
}
