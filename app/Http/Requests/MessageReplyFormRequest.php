<?php

namespace App\Http\Requests;

class MessageReplyFormRequest extends Request
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
            'msgAnswer' => 'required',
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
            'msgAnswer' => 'Reply',
        ];
    }
}
