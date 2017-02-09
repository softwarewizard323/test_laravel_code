<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Domain\SendMail;

class ContactController extends Controller
{
    public function index()
    {
        return response()->view('contact');
    }

    public function process(ContactFormRequest $request)
    {
        SendMail::sendContactUs($request);

        return \Response::json([
            'message' => 'Thank you for contacting us. We will be in touch with you very soon.',
            'redirect' => url('/')
        ]);
    }
}
