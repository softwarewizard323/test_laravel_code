<?php

namespace App\Http\Requests;

class ContactFormRequest extends Request
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
            'first_name' => ['required','min:3'],
            'email' => ['required', 'email'],
            'comments' => ['required'],
            'g-recaptcha-response' => ['required', 'recaptcha'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The First Name you entered does not appear to be valid.',
            'first_name.min' => 'The First Name you entered does not appear to be valid.',
            'email.required' => 'The Email Address you entered does not appear to be valid.',
            'email.email' => 'The Email Address you entered does not appear to be valid.',
            'comments.required' => 'The Comments you entered do not appear to be valid.',
            'g-recaptcha-response.required' => 'The reCAPTCHA wasn\'t entered correctly.',
            'g-recaptcha-response.recaptcha' => 'The reCAPTCHA wasn\'t entered correctly.',
        ];
    }
}
