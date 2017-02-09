<?php

namespace App\Http\Requests;

class MessageNewFormRequest extends Request
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
            'msgTitle' => ['sometimes','required'],
            'msgText' => ['sometimes','required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute can\'t be empty!',
        ];
    }

    public function attributes()
    {
        return [
            'msgTitle' => 'Message title',
            'msgText' => 'Message text',
        ];
    }
}
