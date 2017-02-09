<?php

namespace App\Http\Requests;

class AdminSourceRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'source_name' => ['sometimes', 'required'],
            'source_desc' => ['sometimes', 'required'],
            'source_country' => ['sometimes', 'required'],
            'source_price' => ['sometimes', 'required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute cannot be null',
        ];
    }

    public function attributes()
    {
        return [
            'source_name' => 'Source name',
            'source_desc' => 'Source description',
            'source_country' => 'Source country',
            'source_price' => 'Source price',
        ];
    }
}
