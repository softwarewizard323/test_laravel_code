<?php

namespace App\Http\Requests;

class AdminNewsRequest extends Request
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
            'news_title' => ['sometimes', 'required'],
            'news_content' => ['sometimes', 'required']
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
            'news_title' => 'News title',
            'news_content' => 'News content',
        ];
    }
}
